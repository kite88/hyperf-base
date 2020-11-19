#运行命令
php bin/hyperf.php start

#访问路径
http://127.0.0.1:9501

#登录接口 
http://127.0.0.1:9501/login POST
body:{
	"username":"test",
	"password":"123123"
}

#退出登录接口
http://127.0.0.1:9501/logout POST
headers:{
    "token":""
}

#刷新token
http://127.0.0.1:9501/token POST
headers:{
    "token":""
}

#CRUD Demo
http://127.0.0.1:9501/user GET 查询列表
http://127.0.0.1:9501/user/{id} GET 查询单个
http://127.0.0.1:9501/user POST 创建
http://127.0.0.1:9501/user PUT 更新
http://127.0.0.1:9501/user/{id} DELETE 删除




