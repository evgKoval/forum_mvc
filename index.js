const puppeteer = require('puppeteer');
const mysql = require('mysql');
const cron = require('node-cron');

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "root",
    database: "forum_mvc"
});

let scrape = async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto('https://itc.ua/');
    await page.waitFor(1000);

    const result = await page.evaluate(() => {
        let title = document.querySelector('h2').innerText;
        let text = document.querySelector('.entry-excerpt').innerText;

        return {
            title,
            text
        }

    });

    browser.close();
    
    con.connect(function(err) {
        if (err) throw err;
        var sql = "INSERT INTO posts (post_title, post_text, post_category, user_id) VALUES ?";
        var values = [
            [result.title, result.text, '0', '0'],
        ];
        con.query(sql, [values], function (err, result) {
            if (err) throw err;
            console.log('Success');
        });
    });
};



var task = cron.schedule('* * * * *', () => {
    scrape();
});

task.start();

