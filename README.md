# 对数据验证
#### 使用
(```)
$rule = [
	'age'=>['type'=>'int','default'=>0,'vstr'=>'num|>:0'],
	'account'=>['type'=>'str','default'=>'','vstr'=>'must|strIn:word','name'=>'账号必填|账号必须为字母'],
	'email'=>['type'=>'str','default'=>'','vstr'=>'strIs:email'],
	'qq'=>['type'=>'str','default'=>'','vstr'=>'strIs:qq'],
	'ip'=>['type'=>'str','default'=>'','vstr'=>'strIs:ip'],//
	'ip_range'=>['type'=>'str','default'=>'','vstr'=>'strIs:ip_range'],//ip断
	'params'=>[
	    'type'=>'list',
	    'default'=>[],
	    'vstr'=>'count_gt:0',
	    'name'=>'数组必须大于0',
	    'child'=>[
	        'id'=>['type'=>'int','default'=>0,'vstr'=>'must|num|>:0'],      
	    ],
	], 
];
$params = [
	'age'=>1,
	'account'=>'fdsafsdf',
	'email'=>'afsafdsaf@qq.com',
	'qq'=>'43546456',
	'ip'=>'10.10.1.1',
	'ip_range'=>'1.1.1.1-3.3.3.3',//支持 1.1.1.1-3.3.3.3 or 1.1.1.1/25
	'params'=>['id'=>0],
];
$data = Valid::make($rule,$params);
var_export($data);
(```)
