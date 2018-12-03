<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Mailer\Email;
use Cake\Validation\Validator;


/**
 * Members Form.
 */
class ContactForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param Schema $schema From schema
     * @return $this
     */
    protected function _buildSchema(Schema $schema)
    {
        $schema->addField('name', ['type'=>'string']);

        return $schema;
    }

    /**
     * Form validation builder
     *
     * @param Validator $validator to use against the form
     * @return Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $validator->notEmpty('name');
        return $validator;
    }

    /**
     * Defines what to execute once the From is being processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data)
    {

        $email = new Email('custom_profile');
        $email
            ->template('forget')
            ->emailFormat('html')
            ->to('manager@csch.org.au')
            ->subject('Request password reset')
            ->viewVars(['name' => $data['name']])
            ->send();

        return true;
    }
}
