<?php
class MailController extends Zend_Controller_Action
{
	public function sendMailAction()
	{
		ini_set('sendmail_path', "\"C:\xampp\sendmail\sendmail.exe\" -t");
		$mail = new Zend_Mail();
		$mail->setBodyText('This is the text of the mail.');
		$mail->setFrom('somebody@example.com', 'Some Sender');
		$mail->addTo('test@gmail.com', 'Some Recipient');
		$mail->setSubject('TestSubject');
		$mail->send();
		$this->_helper->viewRenderer->setNoRender();
	}
}