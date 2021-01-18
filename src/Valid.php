<?php
namespace Validation;
// +----------------------------------------------------------------------
// |数据验证类
// +----------------------------------------------------------------------
// | Author: liuguogen <liuguogen@yundun.com>
// +----------------------------------------------------------------------

class Valid
{
    
    // 自定义的验证类型
    protected static $type = [];

    // 验证类型别名
    protected $alias = [
        '>' => 'gt', '>=' => 'gte', '<' => 'lt', '<=' => 'lte', '=' => 'eq', 'same' => 'eq',
    ];

    // 当前验证的规则
    protected $rule = [];

    // 验证提示信息
    protected $message = [];
    // 验证字段描述
    protected $field = [];

    // 验证规则默认提示信息
    protected static $typeMsg = [

            'zh'=>[
                'must'        => ['msg'=>':attribute不能为空','code'=>1200010],
                'num'         => ['msg'=>':attribute必须是数字','code'=>1200011],
                'int'         => ['msg'=>':attribute必须是整数','code'=>1200012],
                'float'       => ['msg'=>':attribute必须是浮点数','code'=>1200013],
                'str'         => ['msg'=>':attribute必须是字符串','code'=>1200014],
                'gte'         => ['msg'=>':attribute必须大于等于 :rule','code'=>1200015],
                'gt'          => ['msg'=>':attribute必须大于 :rule','code'=>1200016],
                'lte'         => ['msg'=>':attribute必须小于等于 :rule','code'=>1200017],
                'lt'          => ['msg'=>':attribute必须小于 :rule','code'=>1200018],
                'eq'          => ['msg'=>':attribute必须等于 :rule','code'=>1200019],
                'neq'         => ['msg'=>':attribute必须不等于 :rule','code'=>1200020],
                'gt0'         => ['msg'=>':attribute必须大于0','code'=>1200021],
                'bool'        => ['msg'=>':attribute必须是布尔值','code'=>1200022],
                'regex'       => ['msg'=>':attribute不符合指定规则','code'=>1200023],
                'mac'         => ['msg'=>':attribute不是正确的MAC地址','code'=>1200024],
                'list'        => ['msg'=>':attribute必须是数组','code'=>1200025],
                'must_key'    => ['msg'=>':attribute必须存在 :rule','code'=>1200026],
                'strIn'       => ['msg'=>':attribute格式不符','code'=>1200027],
                'strIs'       => ['msg'=>':attribute格式不符','code'=>1200028],
                'len_gt'      => ['msg'=>':attribute长度必须大于 :rule','code'=>1200029],
                'len_gte'     => ['msg'=>':attribute长度必须大于等于 :rule','code'=>1200030],
                'len_lt'      => ['msg'=>':attribute长度必须小于 :rule','code'=>1200031],
                'len_lte'     => ['msg'=>':attribute长度必须小于等于 :rule','code'=>1200032],
                'suffix'      => ['msg'=>':attribute没有后缀 :rule','code'=>1200033],
                'prefix'      => ['msg'=>':attribute没有并缀 :rule','code'=>1200034],
                'in'          => ['msg'=>':attribute必须在 :rule 范围内','code'=>1200035],
                'not_in'      => ['msg'=>':attribute不能在 :rule 范围内','code'=>1200036],
                'count_gt'    => ['msg'=>':attribute数组必须大于 :rule','code'=>1200037],
                'count_gte'   => ['msg'=>':attribute数组必须大于等于 :rule','code'=>1200038],
                'count_lt'    => ['msg'=>':attribute数组必须小于 :rule','code'=>1200039],
                'count_lte'   => ['msg'=>':attribute数组必须小于等于 :rule','code'=>1200040],
                'unique'      => ['msg'=>':attribute有重复值存在 :rule','code'=>1200041],
                'range'       => ['msg'=>':attribute只能在 :1 - :2 之间','code'=>1200042],
                'not_range'   => ['msg'=>':attribute不能在 :1 - :2 之间','code'=>1200043],
                'max'         => ['msg'=>':attribute长度不能超过 :rule','code'=>1200044],
                'min'         => ['msg'=>':attribute长度不能小于 :rule','code'=>1200045],
                'mustIf'      => ['msg'=>':attribute不能为空','code'=>1200046],// 验证某个字段的值等于某个值的时候必须 mustIf:field,value  'password'=>'mustIf:account,1' 当account的值等于1的时候 password必须
                'mustWith'    => ['msg'=>':attribute不能为空','code'=>1200047],// 验证某个字段有值的时候必须 mustWith:field 'password'=>'mustWith:account' // 当account有值的时候password字段必须
            ],
            'en'=>[
                'must'        => ['msg'=>':attribute must','code'=>1200010],
                'num'         => ['msg'=>':attribute must be numeric','code'=>1200011],
                'int'         => ['msg'=>':attribute must be integer','code'=>1200012],
                'float'       => ['msg'=>':attribute must be float','code'=>1200013],
                'str'         => ['msg'=>':attribute must be string','code'=>1200014],
                'gte'         => ['msg'=>':attribute must greater than or equal :rule','code'=>1200015],
                'gt'          => ['msg'=>':attribute must greater than :rule','code'=>1200016],
                'lte'         => ['msg'=>':attribute must less than or equal :rule','code'=>1200017],
                'lt'          => ['msg'=>':attribute must less than :rule','code'=>1200018],
                'eq'          => ['msg'=>':attribute must equal :rule','code'=>1200019],
                'neq'         => ['msg'=>':attribute must not equal :rule','code'=>1200020],
                'gt0'         => ['msg'=>':attribute must greater than 0','code'=>1200021],
                'bool'        => ['msg'=>':attribute must be bool','code'=>1200022],
                'regex'       => ['msg'=>':attribute not conform to the rules','code'=>1200023],
                'mac'         => ['msg'=>':attribute not the correct mac address','code'=>1200024],
                'list'        => ['msg'=>':attribute must be a array','code'=>1200025],
                'must_key'    => ['msg'=>':attribute must exist :rule','code'=>1200026],
                'strIn'       => ['msg'=>':attribute format inconsistent','code'=>1200027],
                'strIs'       => ['msg'=>':attribute format inconsistent','code'=>1200028],
                'len_gt'      => ['msg'=>':attribute length must greater than :rule','code'=>1200029],
                'len_gte'     => ['msg'=>':attribute length must greater than or equal :rule','code'=>1200030],
                'len_lt'      => ['msg'=>':attribute length must less than :rule','code'=>1200031],
                'len_lte'     => ['msg'=>':attribute length must less than or equal :rule','code'=>1200032],
                'suffix'      => ['msg'=>':attribute not suffix :rule','code'=>1200033],
                'prefix'      => ['msg'=>':attribute not prefix :rule','code'=>1200034],
                'in'          => ['msg'=>':attribute must be in :rule','code'=>1200035],
                'not_in'      => ['msg'=>':attribute be notin :rule','code'=>1200036],
                'count_gt'    => ['msg'=>':attribute array must greater than :rule','code'=>1200037],
                'count_gte'   => ['msg'=>':attribute array must greater than or equal :rule','code'=>1200038],
                'count_lt'    => ['msg'=>':attribute array must less than :rule','code'=>1200039],
                'count_lte'   => ['msg'=>':attribute array must less than or equal :rule','code'=>1200040],
                'unique'      => ['msg'=>':attribute repeat value exists :rule','code'=>1200041],
                'range'       => ['msg'=>':attribute must between :1 - :2 之间','code'=>1200042],
                'not_range'   => ['msg'=>':attribute not between :1 - :2 之间','code'=>1200043],
                'max'         => ['msg'=>'max size of :attribute must be :rule','code'=>1200044],
                'min'         => ['msg'=>'min size of :attribute must be :rule','code'=>1200045],
                'mustIf'      => ['msg'=>':attribute can not be empty','code'=>1200046],// 验证某个字段的值等于某个值的时候必须 mustIf:field,value  'password'=>'mustIf:account,1' 当account的值等于1的时候 password必须
                'mustWith'    => ['msg'=>':attribute can not be empty','code'=>1200047],// 验证某个字段有值的时候必须 mustWith:field 'password'=>'mustWith:account' // 当account有值的时候password字段必须
            ],
            
    ];

    // 当前验证场景
    protected $currentScene = null;

    // 正则表达式 regex = ['zip'=>'\d{6}',...]
    protected $regex = [];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [];

    // 验证失败错误信息
    protected $error = [];

    // 批量验证
    protected $batch = false;
    
    //多语言 默认中文
    protected $lang = 'zh';
    protected $merge_title = [];
    /**
    * PHP 参数校验 支持自定义扩展 
    * 使用说明 
    * @example
    * gt gte lt lte eq neq 支持别名使用 > 大于 >= 大于等于 < 小于 <= 小于等于 = 等于 
    * $rule = [
    *   'age'=>['type'=>'int','default'=>0,'vstr'=>'num|>:0','name'=>'年龄必须为数字|年龄必须大于0'],
    *   'account'=>['type'=>'str','default'=>'','vstr'=>'must|strIn:word','name'=>'账号必填|账号必须为字母'],
    *   'email'=>['type'=>'str','default'=>'','vstr'=>'strIs:email'],
    *   'qq'=>['type'=>'str','default'=>'','vstr'=>'strIs:qq'],
    *   'ip'=>['type'=>'str','default'=>'','vstr'=>'strIs:ip'],//
    *   'ip_range'=>['type'=>'str','default'=>'','vstr'=>'strIs:ip_range'],//ip断
    *   'params'=>[
    *      'type'=>'list',
    *      'default'=>[],
    *      'vstr'=>'count_gt:0',
    *      'name'=>'数组必须大于0',
    *      'child'=>[
    *          'id'=>['type'=>'int','default'=>0,'vstr'=>'num|>:0'],
    *          
    *      ],
    *   ], 
    * ];
    *
    * $data = [
    *    'age'=>1,
    *    'account'=>'fsfaaxafdsf',
    *    'email'=>'afsafdsaf@qq.com',
    *    'qq'=>'43546456',
    *    'ip'=>'10.10.1.1',
    *    'ip_range'=>'1.1.1.1-3.3.3.3',//支持 1.1.1.1-3.3.3.3 or 1.1.1.1/25
    *    'params'=>['id'=>1],
    * ];
    * $lang = 'zh'; zh / en
    * // 不传msg 支持多语言 支持 zh en zh 中文 en 英文
    * //rule 规则 data 数据 lang 语言  默认中文 zh 中文 en 英文 
    * $result = \Library\Valid::make($rule,$data,$lang);
    * if($result['msg']) { 
    * //说明有错误信息 返回msg code data为空
    *   $result['msg'];
    *   $result['code'];
    * }
    * $params = $result['data'];//返回正确的 data  数据
    *
    */

    /**
     * 构造函数
     * @access public
     * @param array $rules 验证规则
     * @param array $message 验证提示信息
     * @param array $field 验证字段描述信息
     */
    

    public function __construct(array $rules = [], $message = [], $field = [],$lang='zh')
    {

        $this->lang = $lang;
        
       
        $this->rule    = array_merge($this->rule, $rules);
        $this->message = array_merge($this->message, $message);
        $this->field   = array_merge($this->field, $field);
        
    }

    /**
     * 实例化验证
     * @access public
     * @param array     $rules 验证规则
     * @param array     $message 验证提示信息
     * @param array     $field 验证字段描述信息
     * @return Validate
     */
    public static  function make($rules = [], $data=[],$lang = 'zh',$message = [], $field = [])
    {

        $validate = new self($rules, $message, $field,$lang);
        
        if(!$validate->check($data,$validate->rule)) {
            $data = $validate->getError();
            $data['data'] = [];
            return $data;
        }else {
            
            $validate->__returnData($data,$validate->rule);
            return ['msg'=>'','code'=>'','data'=>$data];
        }
        
    }



    /**
     * @param  获取数据
     * @param  [type]
     * @return [type]
     */
    private function __returnData(&$data,$rules) {
        //!in_array($key, array_keys($rules)
        if(is_array($data)) {
            foreach ($data as $key => $value) {
                if(!isset($rules[$key])) {
                   unset($data[$key]);
                }
            }
            

            foreach ($rules as $key => $value) {
                if(isset($value['child']) && is_array($value['child']) && $value['child']) {
                    
                    $this->__returnData($data[$key],$value['child']);
                }
                if(isset($value['default']) && ($value['default']!='' || !empty($value['default']) || in_array($value['default'], [0,'0']) ) && !$data[$key] ) {
                    $data[$key] = $value['default'];
                }
            }
        }
    }
    
    
    /**
     * 数据自动验证
     * @access public
     * @param array     $data  数据
     * @param mixed     $rules  验证规则
     * @param string    $scene 验证场景
     * @return bool
     */
    public function check($data, $rules = [], $msg_title=[],$scene = '') {

        //$this->error = [];
        
        $this->merge_title = array_merge($this->merge_title,$msg_title);
        
        

        // 读取验证规则
        if (empty($rules)) $rules = $this->rule;

        foreach($rules as $key => $item) {
            $rule = $item['vstr'];
            $type = $item['type'];
            if(!$type) $this->error =  ['msg'=>$key.'must type','code'=>1200048]; 
            

            if (isset($item['name'])) {
                $msg = strpos($item['name'], '|') ? explode('|', $item['name']) : $item['name'];
            } else {
                $msg = [];
            }

            if (strpos($key, '|')) {
                // 字段|描述 用于指定属性名称
                list($key, $title) = explode('|', $key);
            } else {
                $title = isset($this->field[$key]) ? $this->field[$key] : $key;
            }
            
            if($this->merge_title) {
                $title = implode('/',$this->merge_title).'/';
            }
            
            $value = $this->getDataValue($data, $key);
            if('mix' != $type ) {

                $result = $this->checkItem($key, $value, $type, $data, $title, []); //$this->is($value,$type,$data);
                
                if (true !== $result) {
                    // 没有返回true 则表示验证失败
                    $this->error = $result;
                    return false;
                }
            }

            if(!strpos($rule, ':') && $rule == 'in') {
                if(isset($item['in_data']) && is_array($item['in_data'])) {
                    $rule = 'in'.':'.implode(',', $item['in_data']);
                }
                if(isset($item['in_kdata']) && is_array($item['in_kdata'])) {
                    $rule = 'in'.':'.implode(',', array_keys($item['in_kdata']));
                }
            }
            // 获取数据 支持二维数组
            $value = $this->getDataValue($data, $key);

            if(strpos($rule, ':')) {
                $m_rule = explode(':', $rule);
                if(in_array($m_rule[0], ['must_key','mustIf','mustWith'])) {
                   $result =   $this->checkItem($key, $value, $rule, $data, $title, $msg);
                   if (true !== $result) {
                        // 没有返回true 则表示验证失败
                        $this->error = $result;
                        return false;
                    }
                } 
            }
            
            if(isset($item['child']) && $item['child'] && is_array($item['child'])) {


                $result = $this->check($data[$key],$item['child'],[$key]);

                if (true !== $result) {

                    return false;
                }
            }

            // 字段验证
            if ($rule instanceof \Closure) {
                // 匿名函数验证 支持传入当前字段和所有字段两个数据
                $result = call_user_func_array($rule, [$value, $data]);
            } else {

                $result = $this->checkItem($key, $value, $rule, $data, $title, $msg);
            }

            if (true !== $result) {
                // 没有返回true 则表示验证失败
                $this->error = $result;
                return false;
            }


        }

        return !empty($this->error) ? false : true;
    }

    /**
     * 验证必须存在的key
     * @access protected
     * @param  mixed     $value 字段值
     * @param  mixed     $rules 验证规则
     * @return bool
     */
    protected function must_key($value,$rule) {
        $mustKey = explode(',', $rule);
        $result = true;
        foreach ($mustKey as $key => $field) {
            if(!in_array($field, array_keys($value))) {
                $result = false;
                break;
            }
        }

        return $result;
    }

    /**
     * 根据验证规则验证数据
     * @access protected
     * @param  mixed     $value 字段值
     * @param  mixed     $rules 验证规则
     * @return bool
     */
    protected function checkRule($value, $rules)
    {
        if ($rules instanceof \Closure) {
            return call_user_func_array($rules, [$value]);
        } elseif (is_string($rules)) {
            $rules = explode('|', $rules);
        }

        foreach ($rules as $key => $rule) {
            if ($rule instanceof \Closure) {
                $result = call_user_func_array($rule, [$value]);
            } else {
                // 判断验证类型
                list($type, $rule) = $this->getValidateType($key, $rule);

                $callback = isset(self::$type[$type]) ? self::$type[$type] : [$this, $type];

                $result = call_user_func_array($callback, [$value, $rule]);
            }

            if (true !== $result) {
                return $result;
            }
        }

        return true;
    }

    /**
     * 验证单个字段规则
     * @access protected
     * @param string    $field  字段名
     * @param mixed     $value  字段值
     * @param mixed     $rules  验证规则
     * @param array     $data  数据
     * @param string    $title  字段描述
     * @param array     $msg  提示信息
     * @return mixed
     */
    protected function checkItem($field, $value, $rules, $data, $title = '', $msg = []) {
        // 支持多规则验证 must|in:a,b,c|... 或者 ['must','in'=>'a,b,c',...]
        if(is_string($rules)) $rules = explode('|', $rules);
        $i = 0;
        
        foreach ($rules as $key => $rule) {
            if($rule instanceof \Closure) {
                $result = call_user_func_array($rule, [$value, $data]);

                $info   = is_numeric($key) ? '' : $key;
            } else {
                // 判断验证类型
                list($type, $rule, $info) = $this->getValidateType($key, $rule);

                if('list'== $rule) {
                    $result = $this->is($value,$rule);
                    
                }
                // 如果不是must 有数据才会行验证
                elseif ($rule != '' && (0 === strpos($info, 'must') ||  (!is_null($value) && '' !== $value))) {

                    // 验证类型
                    $callback = isset(self::$type[$type]) ? self::$type[$type] : [$this, $type];

                    // 验证数据
                    $result = call_user_func_array($callback, [$value, $rule, $data, $field, $title]);

                } else {
                    $result = true;
                }
            }

            if (false === $result) {
                // 验证失败 返回错误信息
                if (isset($msg[$i])) {
                    $message = $msg[$i];
                    if (is_string($message) && strpos($message, '{%') === 0) {
                        $message = substr($message, 2, -1);
                    }
                } else {
                    
                   
                    $message = $this->getRuleMsg($field, $title, $info, $rule);
                   
                }

                
                return ['msg'=>$message,'code'=>isset(self::$typeMsg[$this->lang][$info]['code']) ?  self::$typeMsg[$this->lang][$info]['code'] : 1200010 ];
            } elseif (true !== $result) {
                // 返回自定义错误信息
                if (is_string($result) && false !== strpos($result, ':')) {

                    $result = str_replace([':attribute', ':rule'], [$title, (string) $rule], $result);
                }
                return $result;
            }
            $i++;
        }
        return $result;
    }

    /**
     * 获取当前验证类型及规则
     * @access public
     * @param  mixed     $key
     * @param  mixed     $rule
     * @return array
     */
    protected function getValidateType($key, $rule) {
        // 判断验证类型
        if (!is_numeric($key)) return [$key, $rule, $key];
        if (strpos($rule, ':')) {
            list($type, $rule) = explode(':', $rule, 2);

            if (isset($this->alias[$type])) {
                // 判断别名
                $type = $this->alias[$type];
            }
            $info = $type;
        } elseif (method_exists($this, $rule)) {
            $type = $rule;
            $info = $rule;
            $rule = '';
        } else {
            $type = 'is';
            $info = $rule;
        }

        return [$type, $rule, $info];
    }
    
    /**
     * 验证数据最大长度
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function max($value, $rule) {
        if (is_array($value)) {
            $length = count($value);
        } elseif ($value instanceof File) {
            $length = $value->getSize();
        } else {
            $length = mb_strlen((string) $value);
        }
        return $length <= $rule;
    }

    /**
     * 验证数据最小长度
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function min($value, $rule) {
        if (is_array($value)) {
            $length = count($value);
        } elseif ($value instanceof File) {
            $length = $value->getSize();
        } else {
            $length = mb_strlen((string) $value);
        }
        return $length >= $rule;
    }
    /**
     * 验证是否大于等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function gte($value, $rule, $data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value >= $val;
    }

    /**
     * 验证是否大于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function gt($value, $rule, $data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value > $val;
    }

    /**
     * 验证是否小于等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function lte($value, $rule, $data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value <= $val;
    }

    /**
     * 验证是否小于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function lt($value, $rule, $data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value < $val;
    }

    /**
     * 验证是否大于0
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function gt0($value,$rule,$data) {
        return (int)$value > 0;  
    }

    /**
     * 验证是否等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function eq($value, $rule) {
        return $value == $rule;
    }

    /**
     * 验证是否不等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function neq($value, $rule) {
        return $value != $rule;
    }

    /**
    * 验证数组是否大于某个值
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @param array     $data  数据
    * @return bool
    */
    protected function count_gt($value,$rule,$data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && is_array($value) && count($value) > $val;
    }

    /**
    * 验证数组是否大于等于某个值
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @param array     $data  数据
    * @return bool
    */
    protected function count_gte($value,$rule,$data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && is_array($value) && count($value) >= $val;
    }

    /**
    * 验证数组是否小于某个值
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @param array     $data  数据
    * @return bool
    */
    protected function count_lt($value,$rule,$data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && is_array($value) && count($value) < $val;
    }

    /**
    * 验证数组是否小于等于某个值
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @param array     $data  数据
    * @return bool
    */
    protected function count_lte($value,$rule,$data) {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && is_array($value) && count($value) <= $val;
    }

    /**
    * 验证数组是否唯一
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @param array     $data  数据
    * @return bool
    */
    protected function unique($value,$rule,$data) {
        return is_array($value)  && count($value) == count(array_unique($value));
    }

    /**
     * 验证字段值是否为有效格式
     * @access protected
     * @param mixed     $value  字段值
     * @param string    $rule  验证规则
     * @param array     $data  验证数据
     * @return bool
     */
    protected function is($value, $rule, $data = []) {
        switch ($rule) {
            case 'must':
                // 必须
                $result = !empty($value) || '0' == $value;
                break;
             case 'str':
                // 是否是字符串
                $result = is_string($value) && ''!=(string) $value && !empty($value);
                break;
            case 'float':
                // 是否为float
                $result = $this->filter($value, FILTER_VALIDATE_FLOAT) && is_float($value);
                break;
            case 'num':
                $result = ctype_digit((string) $value);
                break;
            case 'int':
                // 是否为整型
                $result = $this->filter($value, FILTER_VALIDATE_INT);
                break;
            case 'boolean':
            case 'bool':
                // 是否为布尔值
                $result = in_array($value, [true, false, 0, 1, '0', '1'], true);
                break;
            case 'list':
                // 是否为数组
                $result = is_array($value) && !empty($value);
                break;
            default:
                if (isset(self::$type[$rule])) {
                    // 注册的验证规则
                    $result = call_user_func_array(self::$type[$rule], [$value]);
                } else {
                    // 正则验证
                    $result = $this->regex($value, $rule);
                }
        }
        return $result;
    }

    /**
     * 使用filter_var方式验证
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function filter($value, $rule) {
        if (is_string($rule) && strpos($rule, ',')) {
            list($rule, $param) = explode(',', $rule);
        } elseif (is_array($rule)) {
            $param = isset($rule[1]) ? $rule[1] : null;
            $rule  = $rule[0];
        } else {
            $param = null;
        }
        return false !== filter_var($value, is_int($rule) ? $rule : filter_id($rule), $param);
    }

    /**
     * 验证某个字段等于某个值的时候必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function mustIf($value, $rule, $data) {
        list($field, $val) = explode(',', $rule);

        if ($this->getDataValue($data, $field) == $val) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 通过回调方法验证某个字段是否必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function mustCallback($value, $rule, $data) {
        $result = call_user_func_array($rule, [$value, $data]);
        if ($result) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 验证某个字段有值的情况下必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function mustWith($value, $rule, $data) {
        $val = $this->getDataValue($data, $rule);
        if (!empty($val)) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 验证是否在范围内
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function in($value, $rule) {
        return in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * 验证是否不在某个范围
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function not_in($value, $rule) {
        return !in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
    * range验证数据
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function range($value, $rule) {
        if (is_string($rule)) $rule = explode(',', $rule);
        list($min, $max) = $rule;
        return $value >= $min && $value <= $max;
    }

    /**
    * 使用not_range验证数据 不在某个范围
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function not_range($value, $rule) {
        if(is_string($rule)) $rule = explode(',', $rule);
        list($min, $max) = $rule;
        return $value < $min || $value > $max;
    }

    /**
    * strIs验证数据
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function strIs($value,$rule) {
        if(is_string($rule)) {
            switch ($rule) {
                case 'email'://验证邮箱
                    $result = $this->filter($value, FILTER_VALIDATE_EMAIL);
                    break;
                case 'mobile'://验证手机
                    $result = $this->regex($value, '/^1[3-9][0-9]\d{8}$/');
                    break;
                case 'url'://验证url
                    $result = $this->filter($value, FILTER_VALIDATE_URL);
                    break;
                case 'domain'://验证domain
                    // if (!in_array($rule, ['A', 'MX', 'NS', 'SOA', 'PTR', 'CNAME', 'AAAA', 'A6', 'SRV', 'NAPTR', 'TXT', 'ANY'])) {
                    //     $rule = 'MX';
                    // }
                    $result = $this->regex($value,'/^[a-z\d\-*]+(\.[a-z\d\-]+)+$/'); //checkdnsrr($value, $rule);
                    break;
                case 'ip': //验证ip
                    $result = $this->filter($value, [FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6]);
                    break;
                case 'ipv4'://验证ipv4
                    $result = $this->filter($value, [FILTER_VALIDATE_IP, FILTER_FLAG_IPV4]);
                    break;
                case 'ipv6'://验证ipv6
                    $result = $this->filter($value, [FILTER_VALIDATE_IP, FILTER_FLAG_IPV6]);
                    break;
                case 'mac':
                    //是否是MAC地址
                    $result = $this->filter($value, FILTER_VALIDATE_MAC);
                    break;
                case 'date': //验证 日期 格式 2019-11-18
                    $result = $this->regex($value,'/^[12]\d\d\d)-(0?[1-9]|1[0-2])-(0?[1-9]|[12]\d|3[0-1])$/');
                    break;
                case 'time'://验证时间  格式 20:12:14
                    $result = $this->regex($value,'/^([0-1]\d|2[0-4]):([0-5]\d)(:[0-5]\d)$/');
                    break;
                case 'datetime': //验证日期时间 格式 2019-11-18 14:10:51
                    $result = $this->regex($value,'/^([12]\d\d\d)-(0?[1-9]|1[0-2])-(0?[1-9]|[12]\d|3[0-1]) ([0-1]\d|2[0-4]):([0-5]\d)(:[0-5]\d)?$/');
                    break;
                case 'json'://验证json
                    $is_json = !is_string($value) && in_array($value, ['true','false',true, false, 0, 1, '0', '1'], true) ? false :true;
                    if($is_json) {
                        json_decode($value);
                        $result = json_last_error() === JSON_ERROR_NONE;
                    }else {
                        $result = false;
                    }
                    break;
                case 'ip_range':
                    $result = $this->validIpRange($value);
                    break;
                case 'qq'://验证QQ
                    $result = $this->regex($value, '/\d{5,11}/');
                    break;
                case 'port': //验证端口
                    $result = $this->checkPort($value);
                    break;
                case 'lanIp': //验证是否为局域网ip
                    $result = $this->regex($value,'/^(127\.0\.0\.1)|(localhost)|(10\.\d{1,3}\.\d{1,3}\.\d{1,3})|(172\.((1[6-9])|(2\d)|(3[01]))\.\d{1,3}\.\d{1,3})|(192\.168\.\d{1,3}\.\d{1,3})$/');
                    break;
                case 'notLanIp':
                    //$result = $this->validIpv4($value) && $this->isLanIp($value);
                    $result = $this->validIpv4($value);
                    break;
                case 'portMulti':
                    $result = $this->validPortMulti($value);
                    break;
                case 'domainArr':
                    $result = $this->validDomainArr($value);
                    break;
                case 'ip_cidr'://验证无类别域间路由
                    $result = $this->validIpCidr($value);
                    break;
                case 'zip'://验证邮政编码
                    $result = $this->regex($value, '/\d{6}/');
                    break;
                case 'idCard'://验证身份证号
                    $result = $this->regex($value, '/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$)/');
                    break;
                default:
                    
                    break;
            }
        }
        return $result ? true : false;
    }
    
    /**
     * @param $domains
     * @return int
     * @node_name 验证域名数组
     * @link
     * @desc
     */
    protected function validDomainArr($domains) {
        $domains = (array)$domains;
        foreach ($domains as $domain) {
            if(!$this->paramValidDomain($domain)) return false;
        }

        return true;
    }

    /**
     * @param $param_value
     * @return int
     * @node_name 验证域名
     * @link
     * @desc
     */
    protected  function paramValidDomain($param_value) {
        //域名总长度不能超过255
        if (strlen($param_value) > 255) return false;

        //每个标号长度不能超过63
        $domainLabels = explode('.', $param_value);
        foreach ($domainLabels as $domainLabel) {
            if (strlen($domainLabel) > 63) return false;
        }

        //域名里不能有空格
        if (preg_match('/\s+/', $param_value)) return false;

        return preg_match('/^[a-z\d\-*@]+(\.[a-z\d\-]+)+$/', $param_value) ? true : false;
    }

    /**
     * @param $port
     * @return array
     * @node_name 支持单个端口，数组，，分割的多个端口
     * @link
     * @desc
     */
    protected function validPortMulti($port) {
        if (is_string($port)) {
            $ports = explode(",", $port);
        } else if (is_array($port)) {
            $ports = $port;
        } else {
            $ports = $port;
        }
        foreach ($ports as $p) {
            if (!$this->checkPort($p)) {
                return false;
            }
        }

        return true;
    }

    //检测是否符合ipv4格式，$checkPort是否检测端口
    protected function validIpv4($ip_addr, $checkPort = false){
        if ($checkPort && false !== strpos($ip_addr, ':')) {
            list($ip_addr, $port) = explode(':', $ip_addr, 2);
            if (!$this->checkPort($port)) {
                return false;
            }
        }

        return filter_var($ip_addr, FILTER_VALIDATE_IP);
    }


    //私有Ip实现2 $valid_127 是否验证127开头的
   protected function isLanIp($ip, $valid_127 = true, $checkPort = true) {
        if ($checkPort) {
            if ($pos = strpos($ip, ':')) {
                list($ip, $port) = explode(':', $ip, 2);
            }
        }
        $ip2l  = ip2long(trim($ip));
        $net_a = ip2long('10.255.255.255') >> 24; //A类网预留ip的网络地址
        $net_b = ip2long('172.31.255.255') >> 20; //B类网预留ip的网络地址
        $net_c = ip2long('192.168.255.255') >> 16; //C类网预留ip的网络地址

        return $ip2l >> 24 === $net_a || $ip2l >> 20 === $net_b || $ip2l >> 16 === $net_c || ($valid_127 && substr(trim($ip), 0, 3) == '127');
    }

    //检测端口
    protected function checkPort($port){
        if ((is_numeric($port) || is_string($port)) && preg_match('/^\d{1,5}$/', $port)) {
            $port = (int)$port;

            return $port > 0 && $port <= 65535;
        }

        return false;
    }


    /**
     * @node_name 验证IP段是否合法
     * @example   1.1.1.1-1.1.1.3
     * @param $param_value
     * @return int
     */
    protected  function validIpCidr($value) {
        if (false !== strpos($range, '/')) {
            $temp = explode('/', $range, 2);

            if (preg_match('/^(?:\d|[1-3]\d)$/', $temp[1])) {
                $num = (int) $temp[1];
                if ($num >= 0 && $num <= 32 && $this->validIpv4($temp[0])) return true;
            }
            return false;
        }

        if ($this->validIpv4($range)) return true;
        return false;
    }

    /**
     * 验证ip范围
     * @param  [type]
     * @return [type]
     */
    protected  function validIpRange($range) {
        if (false !== strpos($range, '/')) {
            $temp = explode('/', $range, 2);

            if (preg_match('/^(?:\d|[1-3]\d)$/', $temp[1])) {
                $num = (int) $temp[1];

                if ($num >= 0 && $num <= 32 && filter_var($temp[0], FILTER_VALIDATE_IP)) return true;
            }
            return false;
        }

        if (false !== strpos($range, '-')) {
            list($begin, $end) = array_map('ip2long', explode('-', $range, 2));
            if (false !== $begin && false !== $end && $end >= $begin) return true;
            return false;
        }

        if (filter_var($range,FILTER_VALIDATE_IP)) return true;
        return false;
    }

    /**
    * strIn验证数据
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function strIn($value,$rule) {
        if(!is_string($rule)) return false;
        $reg_rule = '';
        $_rule = explode(',', $rule) ;
        foreach ($_rule as $key => $val) {
            switch ($val) {
                case 'word':
                    $reg_rule.='A-Za-z';
                    break;
                case 'num':
                    $reg_rule.='0-9';
                        break;
                case 'hanzi':
                    $reg_rule.='\x{4e00}-\x{9fa5}';
                    break;
                case '-':
                    $reg_rule.='\-';
                    break;
                default:
                    $reg_rule .= '\_';
                    break;
            }
        }

        return $this->regex($value, "/^[{$reg_rule}]+$/u");
    }

    /**
    * 字符串长度大于
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function len_gt($value,$rule) {
        if(!is_string($value)) return false;
        return mb_strlen((string)$value) > $rule;
    }

    /**
    * 字符串长度大于等于
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function len_gte($value,$rule) {
        if(!is_string($value)) return false;
        return mb_strlen((string)$value) >= $rule;
    }

    /**
    * 字符串长度小于
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function len_lt($value,$rule) {
        if(!is_string($value)) return false;
        return mb_strlen((string)$value) < $rule;
    }

    /**
    * 判断字符串是否有后缀
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function suffix($value, $rule) {
        if(!is_string($value)) return false;
        return strripos($value, $rule) ? true :false;
    }

    /**
    * 判断字符串是否有前缀
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function prefix($value,$rule) {
        if(!is_string($value)) return false;
        return stripos($value, $rule) ? true :false;
    }

    /**
    * 字符串长度小于等于
    * @access protected
    * @param mixed     $value  字段值
    * @param mixed     $rule  验证规则
    * @return bool
    */
    protected function len_lte($value,$rule) {
        if(!is_string($value)) return false;
        return mb_strlen((string)$value) <= $rule;
    }

    /**
     * 使用正则验证数据
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则 正则规则或者预定义正则名
     * @return mixed
     */
    protected function regex($value, $rule) {
        if (isset($this->regex[$rule])) {
            $rule = $this->regex[$rule];
        }
        if (0 !== strpos($rule, '/') && !preg_match('/\/[imsU]{0,4}$/', $rule)) {
            // 不是正则表达式则两端补上/
            $rule = '/^' . $rule . '$/';
        }
        return is_scalar($value) && 1 === preg_match($rule, (string) $value);
    }

    // 获取错误信息
    public function getError() {
        return $this->error;
    }

    /**
     * 获取数据值
     * @access protected
     * @param array $data 数据
     * @param string $key 数据标识 支持二维
     * @return mixed
     */
    protected function getDataValue($data, $key) {
        if (is_numeric($key)) {
            $value = $key;
        }elseif (strpos($key, '.')) {
            // 支持二维数组验证
            list($name1, $name2) = explode('.', $key);
            $value               = isset($data[$name1][$name2]) ? $data[$name1][$name2] : null;
        } else {
            $value = isset($data[$key]) ? $data[$key] : null;
        }
        return $value;
    }

    /**
     * 获取验证规则的错误提示信息
     * @access protected
     * @param string    $attribute  字段英文名
     * @param string    $title  字段描述名
     * @param string    $type  验证规则名称
     * @param mixed     $rule  验证规则数据
     * @return string
     */
    protected function getRuleMsg($attribute, $title, $type, $rule) {
        
        
        if(isset($type['msg'])) {
            $type_msg = $type['msg'];
        }else {
            $type_msg  ='';
        }
        if (isset($this->message[$attribute . '.' . $type_msg])) {
            $msg = $this->message[$attribute . '.' . $type_msg];
        } elseif (isset($this->message[$attribute][$type]['msg'])) {
            $msg = $this->message[$attribute][$type]['msg'];
        } elseif (isset($this->message[$attribute])) {
            $msg = $this->message[$attribute];
        } elseif (isset(self::$typeMsg[$this->lang][$type]['msg'])) {
            $msg = self::$typeMsg[$this->lang][$type]['msg'];
        } elseif (0 === strpos($type, 'must')) {
            $msg = self::$typeMsg[$this->lang]['must']['msg'];
        } else {
            $msg = $this->lang =='zh' ? $attribute . ' 类型不存在' : $attribute . ' type not exists';
        }

        if (is_string($msg) && 0 === strpos($msg, '{%')) {
            $msg = substr($msg, 2, -1);
        }

        if (is_string($msg) && is_scalar($rule) && false !== strpos($msg, ':')) {
            // 变量替换
            if (is_string($rule) && strpos($rule, ',')) {
                $array = array_pad(explode(',', $rule), 3, '');
            } else {
                $array = array_pad([], 3, '');
            }
            $msg = str_replace(
                [':attribute', ':rule', ':1', ':2', ':3'],
                [$attribute, (string) $rule, $array[0], $array[1], $array[2]],
                $msg);
        }
        
        if($title!=$attribute) {
            $msg = $title.$msg;
        }
        return $msg;
    }

}
