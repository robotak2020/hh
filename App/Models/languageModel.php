<?php


namespace App\Models;

use http\Client\Curl\User;
use System\Application;
use System\Model;
use Countable;

/**
 * Class languageModel
 * @package App\Models
 */
class languageModel extends Model
{
    /**
     * Table name
     * @var string
     */

    protected $table = 'langs';

    public function get_languages($lang = 'english')
    {
        $langs = $this->select('*')->from($this->table)->limit(0)->fetch();
        unset($langs->id);
        unset($langs->lang_key);
        unset($langs->type);
        return array_keys(get_object_vars($langs));
    }

    public function get_word ($lang_key)
    {
        if (!empty($this->session->get('lang'))) {
            $get_word = $this->select($this->session->get('lang'))->from($this->table)->where('lang_key=?', $lang_key)->fetch();
        }else if (!empty($this->cookie->get('lang'))) {
            $get_word = $this->select($this->cookie->get('lang'))->from($this->table)->where('lang_key=?', $lang_key)->fetch();
        } else {
            $get_word = $this->select('english')->from($this->table)->where('lang_key=?', $lang_key)->fetch();
        }
        return $get_word;
    }
}