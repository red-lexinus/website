async function fun(){
    alert(324234)
    const mysql = require('mysql');
    const connection = mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: '',
        // port: '8000',
        database:'poet'
    });
    connection.connect(function(err){
        if (err) {
        return console.error("Ошибка: " + err.message);
        }
        else{
        console.log("Подключение к серверу MySQL успешно установлено");
        }
    });
}