<?php
/**
 * Created by PhpStorm.
 * User: denverb
 * Date: 18/5/11
 * Time: 下午3:37
 */

namespace App\Providers;


use App\Jobs\SendEmail;
use App\Message;

class MessageServiceProvider
{
	private $_message;

	public function __construct(Message $message)
	{
		$this->_message = $message;
	}


	public function create()
	{

		$this->_message->save();
		SendEmail::dispatch($this->_message);
		return true;
	}

	public function delete()
	{
		return $this->_message->delete();

	}

	public function read()
	{
		$this->_message->status = 1;
		return $this->_message->save();
	}

}