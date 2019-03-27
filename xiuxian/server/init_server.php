<?php
$dbhost = 'localhost';  // mysql服务器主机地址
$dbuser = 'root';            // mysql用户名
$dbpass = '123456';          // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('连接错误: ' . mysqli_error($conn));
}
echo '连接成功<br />';
$sql = 'CREATE DATABASE XIUXIAN';
$retval = mysqli_query($conn,$sql );
mysqli_select_db( $conn, 'XIUXIAN' );
    // 创建了数据库，开始创建表单

        
    $sql = "CREATE TABLE CENTER_DATA( ". // 中心数据表
	"ID INT NOT NULL AUTO_INCREMENT, ". // id
        "SERVER_NAME_LIST VATCHAR(100), ". // 服务器名字列表 xx|xx|xx
        "); ";
    $retval = mysqli_query( $conn, $sql );


    $sql = "CREATE TABLE ACCOUNT_LIST( ". // 创建账号表
        "ACCOUNT_ID INT NOT NULL AUTO_INCREMENT, ". // 账号id
        "ACCOUNT_NAME VARCHAR(100) NOT NULL, ". // 账号名
        "PASSWORD VARCHAR(100) NOT NULL, ". // 密码
        "PHONE VARCHAR(100) NOT NULL, ". // 手机
        "CARD VARCHAR(100) NOT NULL, ". // 身份证
        "NAME VARCHAR(100) NOT NULL, ". // 姓名
        "PAY VARCHAR(100) NOT NULL, ". // 累积充值金额
        "TEMP VARCHAR(100) NOT NULL, ". // 临时登陆凭证
        "TEMP_TIME VARCHAR(100) NOT NULL, ". // 生一次生成临时登录凭证的时间
        "PRIMARY KEY ( ACCOUNT_ID,ACCOUNT_NAME )); ";
    $retval = mysqli_query( $conn, $sql );

    $sql = "CREATE TABLE SERVER_LIST( ". // 创建服务器表
        "SERVER_ID INT NOT NULL AUTO_INCREMENT, ". // 账号id
        "STTE INT, ". // 服务器状态
        "COUNT INT, ". // 人数
	"OPEN_TIME INT,". // 开服时间
        "PRIMARY KEY ( SERVER_ID )); ";
    $retval = mysqli_query( $conn, $sql );

    $sql = "CREATE TABLE CHARACTER_LIST( ". // 角色表
        "CHARACTER_ID INT NOT NULL AUTO_INCREMENT, ". // 角色ID
        "ACCOUNT_ID INT, ". // 账号ID
        "SERVER_ID INT, ". // 服务器ID
        "LEVEL INT, ". // 等级
        "PRIMARY KEY ( CHARACTER_ID )); ";
    $retval = mysqli_query( $conn, $sql );


    $sql = "CREATE TABLE SERVER_DATA_1( ". //  一区服务器数据表
        "CHARACTER_ID INT NOT NULL, ". // 角色ID
        "CHARACTER_NAME VARCHAR(100) NOT NULL, ". // 昵称
        "LEVEL INT, ". // 等级
        "GOLD INT, ". // 元宝
        "COIN INT, ". // 金币
        "PRIMARY KEY ( CHARACTER_ID )); ";
    $retval = mysqli_query( $conn, $sql );

    // 创建服务器初始数据
$sql = "INSERT INTO CENTER_DATA ( SERVER_NAME_LIST ) VALUES ( '魔兽森林|十里桃花|自由之翼|星之祈愿|永恒星辉|星耀天下|龙腾世界|祝福之光|流光岁月|东方大陆|繁星之梦|明月流光|浮光幻境|月影山谷|天使之都|守望深渊|月影传说|皓月大陆|月色琉璃|光明骑士|天启神界|龙马平原|幽影山谷|永恒之心|红龙守护|冰河世界|绝对零度|巨龙吐息|暗影峡谷|梦幻星河|暗黑神域|守望之城|暗影幽谷|骑士王国|战争之主|上古神域|迷幻森林|死神领域|幻影之都|苍穹之巅|希冀之光|天启神殿|恶灵禁地|遗忘古城|流星雨梦|幻影森林|灵动之力|翡翠之门|迷失之城|天启之门|遗忘神迹|奇迹大陆|黎明圣域|光辉圣殿|暗黑战域|密林游侠|暮色港湾|甜水绿洲|迅捷微风|冬日恋曲|纳沙塔尔|诺兹多姆 |雷斧堡垒 |朵丹尼尔|烈火雄心|深渊之路|冰雪世界|寒冰荆棘|暗影突袭|暗金魅影|地狱之石|奥特兰克|嚎风峡湾|恶灵沼泽|鬼雾山峰|利刃之拳|怒火之心|烈焰熔炉|雷炎风暴|暮色海湾|遗忘海岸|暗影之森|逐梦之心|主宰之力|守护之心|银月森林|恶魔邪翼|神圣领域|恶魔法典|雷霆风暴|冰霜之刃|霜魂之力|怒焰狂暴|烈火之灵|神之领域|迷失之岛|冰霜之泪|寒光之泉|神秘之境|飞火流星|落雨峡谷|烈焰风暴|暗影沼泽|魔灵巢穴|守护之力|闪耀之心|龙神禁地|琉璃圣地|冰霜之魂|暗影之巅|毁灭之力|梦之圣地|神话之语|鬼雾峡谷|激流峡湾|翡翠梦境|元素之语|逐梦之路|烈日神殿|暗金神殿|勇士之心|月光林地|幽暗沼泽|暗影之谷|魔兽之魂|暗魂魅影|火羽山脉|红云台地|火焰之森|破碎之心|冰峰之刃|符文图腾|死亡之门|噬灵沼泽|烈焰荆棘|冬泉之谷|黑翼之巢|凤凰之神|奥蕾莉亚|冰川之拳|恶魔之魂|黑暗魅影|雏龙之翼|黑暗虚空|闪电之刃|元素之力|暴风祭坛|大地之怒|刺骨利刃|魔幻之都|黑风哨站|雷霆战歌|灰烬之刃|鲜血熔炉|狂暴之路|暗影荒岛|虚空之影|能源战舰|死亡之翼|巨龙咆哮|兽人堡垒|骑士之光|黑暗龙翼|白骨荒野|狂风峡谷|日落沼泽|时光洞穴|黑石山谷|血色军团|风暴祭坛|熔岩洞穴|暗色魔窟|迷雾峡谷|雪域迷城|生命之树|永恒空间|弑神之刃|赤色要塞|恐怖之源|毁灭祭坛|巨龙峡谷|龙骨平原|万色星辰|海底深渊|暗影裂缝|轻风之语|银月神殿|腥红之月|荒古之城|天空之墙|银月之森|守望之海|水晶之痕|蓝龙巢穴|主宰之剑|死亡战歌|暮色森林|无尽之海|龙之叹息|上古圣地|众生神殿|永恒水晶|守护之魂|耳语海岸|红龙军团|恶魔之翼|恶龙城堡|守护之剑|烈焰之谷|风暴之眼|月光神殿|风暴领域|冰霜利刃|雷霆之怒|熔火之心|神圣之光|深海泰坦|黑山矿道|龙岭山脉|烈焰熔炼|精灵之森|黑山古堡|红石边境|清风溪谷|深渊领主');"
$retval = mysqli_query( $conn, $sql );
    // 创建第一个服务器



    echo "初始化了服务器数据库";

mysqli_close($conn); // 关闭数据库
?>
