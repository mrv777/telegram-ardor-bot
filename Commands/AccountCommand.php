<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Request;

/**
 * User "/explorers" command
 *
 * Display a list of Ardor Explorers
 */
class AccountCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'account';

    /**
     * @var string
     */
    protected $description = 'Get Ardor Account information';

    /**
     * @var string
     */
    protected $usage = '/account';

    /**
     * @var string
     */
    protected $version = '0.1.0';
    
    /**
     * @var bool
     */
    protected $need_mysql = true;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        //You can use $command as param
        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $command = $message->getCommand();
        
        /*$pdo = DB::getPdo();
        $haha = $pdo->prepare("SELECT id FROM forward WHERE id = '117'");
        $haha->execute();
        $hahas = $haha->fetchAll();*/

        $data = [
            'chat_id' => $chat_id,
            'parse_mode' => 'MARKDOWN',
            'text'    => '*Jelurida Mainnet Node*',
        ];

        return Request::sendMessage($data);
    }
}
