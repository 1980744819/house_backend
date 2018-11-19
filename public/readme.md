# **房源管理后台**
## require files
* thinkphp 5.0
* php >=5.0
* apache2.4.27
* mysql5.7.19
* bootstrap 4.0
### apache配置
>监听端口 8086
修改vhosts
Listen 8086
<VirtualHost *:8086>
  DocumentRoot "${INSTALL_DIR}/www/rh/public"
  ServerName rh.com
<\/VirtualHost>

>修改hosts文件
127.0.0.1 rh.com
[修改apache](https://blog.csdn.net/panglongyouhui/article/details/52327148)
[更改防火墙使可通过局域网访问](https://blog.csdn.net/hshl1214/article/details/50724386)

### 入口文件
rh/public/index/index/login
### 访问
[首页](rh.com:8086)
# 用户管理
## 数据库设计
### 创建数据库 house_backend

```sql
create database house_backend;
```
### 切换使用数据库house_backend
```sql
use house_backend;
```




