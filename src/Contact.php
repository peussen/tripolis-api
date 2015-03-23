<?php


namespace HarperJones\Tripolis;


class Contact
{
	private $database;
	private $provider;
	private $fields;
	private $keyfield;

	protected $contact;

	public function __construct(TripolisProvider $provider, $database)
	{
		$this->provider = $provider;
		$this->database = $database;

		$this->getAllFields();
	}

	public function __get($field)
	{
		if ( isset($this->contact[$field])) {
			return $this->contact[$field];
		}
		return null;
	}

	/**
	 * Creates a new user and prepares the internal structure for further instructions
	 * If the user already existed, it will setup the system for that user.
	 *
	 * @param array $values
	 *
	 * @return Contact
	 */
	public function create(array $values)
	{
		try {
			$result = $this->provider->contact()->create(
				$values,
				'name',
				$this->database
			);

			$data = $result->getData();
			if ( isset($data->id)) {
				$id = $data->id;
			} else {
				throw new TripolisException('Create did not return an ID');
			}


		} catch (AlreadyExistsException $e) {
			$id = $e->getId();
		}

		return $this->find('_id',$id);
	}

	/**
	 * Searches a contact based on a field/value
	 *
	 * @param      $fieldOrValue
	 * @param null $value
	 *
	 * @return $this
	 */
	public function find($fieldOrValue,$value = null)
	{
		$this->contact = null;

		if ( $fieldOrValue === '_id' && $value) {
			$result = $this->provider->contact()->database($this->database)->getById($value);

			$this->contact = $result->getData();
		} else {
			if ( $value !== null ) {
				if ( isset($this->fields[$fieldOrValue]) ) {
					$field = $this->fields[$fieldOrValue];
				} else {
					throw new \InvalidArgumentException("No such field $fieldOrValue");
				}
			} else {
				$field = $this->keyfield;
				$value = $fieldOrValue;
			}

			$result = $this->provider->contact()->database($this->database)->search(
				array(
					array($field,$value)
				)
			);

			$response = $result->getData();

			if ( $response->paging->totalItems == 1) {
				if ( isset($response->contacts->contact[0])) {
					$contact = $response->contacts->contact[0];
					$this->storeContactData($contact);
				}
			}
		}
		return $this;
	}

	/**
	 * Checks if we have a contact
	 *
	 * @return bool
	 */
	public function valid()
	{
		return $this->contact !== null;
	}

	public function increment($field)
	{
		$curVal = (int)$this->__get($field);
		return $this->update(array($field => ++$curVal));
	}

	/**
	 * Decrease the value of a field by one
	 *
	 * @param string $field
	 *
	 * @return bool
	 */
	public function decrement($field)
	{
		$curVal = (int)$this->__get($field);
		return $this->update(array($field => --$curVal));
	}

	/**
	 * Updates a contact with the given information
	 *
	 * @param $fields
	 *
	 * @return bool
	 */
	public function update($fields)
	{
		if ( !$this->valid()) {
			return false;
		}

		$internalUpdateFields = array();

		foreach( $fields as $field => $value ) {
			if ( isset($this->fields[$field])) {
				$internalUpdateFields[$this->fields[$field]] = $value;
			} else {
				throw new \InvalidArgumentException("Trying to update a non-existing field $field");
			}
		}

		$this->provider->contact()->database($this->database)->update($this->contact['_id'],$internalUpdateFields,'id');

		$this->updateInternalContact($fields);
		return true;
	}

	/**
	 *
	 *
	 */
	private function getAllFields()
	{
		$response = $this->provider->ContactDatabaseField()->getByContactDatabaseId($this->database);

		$fields = array();
		$pk     = null;

		foreach( $response->getData() as $key => $field ) {
			$fields[$field->name] = $key;

			if ( $field->key && $pk === null) {
				$pk = $key;
			}
		}

		$this->fields   = $fields;
		$this->keyfield = $pk;
	}

	private function storeContactData($contact)
	{
		$fields = array();

		if ( isset($contact->contactId)) {
			$fields['_id'] = $contact->contactId;

			foreach( $contact->contactFields->contactField as $field) {
				if (isset($field->value)) {
					$fields[$field->name] = $field->value;
				} else {
					$fields[$field->name] = null;
				}
			}
		}

		$this->contact = $fields;
	}

	private function updateInternalContact($fields)
	{
		$this->contact = array_merge($this->contact,$fields);
	}
}