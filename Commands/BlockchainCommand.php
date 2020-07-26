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
class BlockchainCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'blockchain';

    /**
     * @var string
     */
    protected $description = 'Get Ardor Blockchain Status';

    /**
     * @var string
     */
    protected $usage = '/blockchain';

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
        
        $jeluridaBlockchainMain = json_decode(file_get_contents("https://ardor.jelurida.com/nxt?requestType=getBlockchainStatus"), true);
    		if(!$jeluridaBlockchainMain) {
    			$jeluridaBlockchainMain['numberOfBlocks'] = "<span class='text-danger'>Error</span>";
    			$jeluridaBlockchainMain['version'] = "<span class='text-danger'>Error</span>";
    		}
       
        $jeluridaBlockchainTest = json_decode(file_get_contents("https://testardor.jelurida.com/nxt?requestType=getBlockchainStatus"), true);
    		if(!$jeluridaBlockchainTest) {
    			$jeluridaBlockchainTest['numberOfBlocks'] = "<span class='text-danger'>Error</span>";
    			$jeluridaBlockchainTest['version'] = "<span class='text-danger'>Error</span>";
    		}

        $data = [
            'chat_id' => $chat_id,
            'parse_mode' => 'MARKDOWN',
            'text'    => '*Jelurida Mainnet Node*
Current Blockchain Height: '.$jeluridaBlockchainMain['numberOfBlocks'].'
Current Version: '.$jeluridaBlockchainMain['version'].'
*Jelurida Testnet Node*
Current Blockchain Height: '.$jeluridaBlockchainTest['numberOfBlocks'].'
Current Version: '.$jeluridaBlockchainTest['version'],
        ];

        return Request::sendMessage($data);
    }
}
