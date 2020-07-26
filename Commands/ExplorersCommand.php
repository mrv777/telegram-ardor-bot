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
class ExplorersCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'explorers';

    /**
     * @var string
     */
    protected $description = 'List Ardor Explorers';

    /**
     * @var string
     */
    protected $usage = '/explorers';

    /**
     * @var string
     */
    protected $version = '0.1.0';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $chat_id = $this->getMessage()->getChat()->getId();

        $explorers = new InlineKeyboard([
            ['text' => 'Ardor.tools', 'url' => 'https://ardor.tools'],
            ['text' => 'Ardor.world', 'url' => 'https://ardor.world'],
        ], [
            ['text' => 'Ardorportal.org', 'url' => 'https://ardorportal.org'],
            ['text' => 'Jelurida Node Explorer', 'url' => 'https://explorer.jelurida.com/ardor/'],
        ]);

        $data = [
            'chat_id'      => $chat_id,
            'text'         => 'Ardor Blockchain Explorers',
            'reply_markup' => $explorers,
        ];

        return Request::sendMessage($data);
    }
}
