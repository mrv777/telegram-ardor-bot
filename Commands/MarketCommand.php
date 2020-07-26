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
class MarketCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'market';

    /**
     * @var string
     */
    protected $description = 'Get Market Information from Coincap.io';

    /**
     * @var string
     */
    protected $usage = '/market';

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
        $message = $this->getMessage();

        //You can use $command as param
        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $command = $message->getCommand();
        
        $ardor_market = json_decode(file_get_contents("https://api.coincap.io/v2/assets/ardor"), true)['data'];
        $ignis_market = json_decode(file_get_contents("https://api.coincap.io/v2/assets/ignis"), true)['data'];
        $bit_market = json_decode(file_get_contents("https://api.coincap.io/v2/assets/bitswift"), true)['data'];

        $data = [
            'chat_id' => $chat_id,
            'parse_mode' => 'MARKDOWN',
            'text'    => '*Ardor Market Information*
Price: $'.number_format($ardor_market['priceUsd'], 4).'
24hr Change: '.number_format($ardor_market['changePercent24Hr'], 2).'%
24hr Volume: $'.number_format($ardor_market['volumeUsd24Hr'], 2).'

*Ignis Market Information*
Price: $'.number_format($ignis_market['priceUsd'], 4).'
24hr Change: '.number_format($ignis_market['changePercent24Hr'], 2).'%
24hr Volume: $'.number_format($ignis_market['volumeUsd24Hr'], 2).'

*Bitswift Market Information*
Price: $'.number_format($bit_market['priceUsd'], 4),
        ];

        return Request::sendMessage($data);
    }
}
