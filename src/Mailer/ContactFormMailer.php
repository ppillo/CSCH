<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * ContactForm mailer.
 */
class ContactFormMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'ContactForm';

    public function submission(array $data)
    {


        $this
            -> profile('gmail')
            -> from('cschsystem@gmail.com', 'Members')
            ->to('manager@csch.org.au', 'Me')
            ->template('default', 'default')
            -> message('Request to reset password')
            ->set(['data'=>$data]);

    }
}
