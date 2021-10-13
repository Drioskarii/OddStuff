const Discord = require('discord.js'); 
const client = new Discord.Client();  

client.on('ready', () => {   
    console.log(`Logged in as ${client.user.tag}!`); 
});client.on('message', msg => {  
    text = msg.content.replace("'",'');
    

    var mysql = require('mysql');
    var pool = mysql.createPool({
        host: "localhost",
        user: "",
        password: "",
        database: ""
        })
    
    if(msg.author.bot) return;
       //Conq Rah
        if (text.toLowerCase().includes("rah")) {
            console.log(msg.author.tag +": "+ text) //messsagelog to server
            msg.channel.send("Rah!")
            //Regex is painful :)
        } else if (text.toLowerCase().match(/^(?=.*\bis|so\b)(?=.*\bop\b)(?!.*\bisnt\b).*$/gm)) {
            console.log(msg.author.tag +": "+ text) //messsagelog to server
            if (Math.floor(Math.random() * 2) == 1) {
                msg.channel.send("\nGood Fight!\nGood Fight!\nGood Fight!")
            } else {
                msg.channel.send("\nWow!\nWow!\nWow!")
            }
            // warthunder tonk links
        } else if (text.match(/{([^}]+)}/gm)) {
            console.log(msg.author.tag +": "+ text) //messsagelog to server
            text = text.replace(/\{|\}/gim,'')
            const rp = require('request-promise');
            const $ = require('cheerio');
            const url = 'https://wiki.warthunder.com/index.php?search='+ encodeURI(text) +'&title=Special%3ASearch&go=Go';
            rp(url)
            .then(function(html){
                msg.channel.send("https://wiki.warthunder.com"+$('div > ul > li > div > a', html)[0].attribs.href);
            })
            .catch(function(err){
                const url = 'https://wiki.warthunder.com/'+ encodeURI(text);
                rp(url)
                .then(function(html){
                    if ($('div > div > div > div > div[class="mw-parser-output"] > div > div > img', html).length > 0) {
                        
                        //success! 
                        msg.channel.send(url);
                        
                    } else {
                        
                        //success! 
                        linkArray = "\n";

                        for (let index = 0; index < $('div > div > div > div > div[class="mw-parser-output"] > ul > li > a', html).length; index++) {
                            linkArray += $($('div > div > div > div > div[class="mw-parser-output"] > ul > li > a', html)[index]).text() + ': ' + 'https://wiki.warthunder.com'+$('div > div > div > div > div[class="mw-parser-output"] > ul > li > a', html)[index].attribs.href + '\n';
                        }
                        msg.channel.send(linkArray)
                    }
                })
                .catch(function(err){
                    msg.channel.send("There were no results matching the query :(")
                    console.log(err)
                });
            });

            //Dice Roller
        } else if (text.toLowerCase().split(' ')[0] == "!roll") {
            diceArray = []
            if (text.toLowerCase().split('!roll ')[1].match(/\b(1d100|d100\w*)\b/)) {
                //convert string to number checker
                console.log(msg.author.tag +": "+ text) //messsagelog to server
                diceArray.push(Math.floor((Math.random() * parseInt(9)))*10);
                diceArray.push(Math.floor((Math.random() * parseInt(9))));

                diceroll = diceArray[0]
                diceresult = diceArray[0]
                for (let index = 1; index < diceArray.length; index++) {
                    diceroll += " + " + diceArray[index]
                    diceresult += diceArray[index]
                    msg.channel.send("Roll Result: __**"+diceresult+"**__ = "+diceroll)
                }
            } else {
                dices = text.toLowerCase().split(' ')[1].split('d')[0];
                dicetype = text.toLowerCase().split(' ')[1].split('d')[1];
                //convert string to number checker
                console.log(msg.author.tag +": "+ text) //messsagelog to server
                if (dices.match(/\D+/gm) || dicetype.match(/\D+/gm)) {
                    console.log("NaN Regex")
                    console.log(text.split(' ')[1].split('d')[1])
                    console.log(text.split(' ')[1].split('d')[0])
                    msg.channel.send("Please use a number :)")
       
    
                } else {
                    while (dices--) {
                        diceArray.push(Math.floor((Math.random() * parseInt(dicetype)) + 1));
                    }
                    diceroll = diceArray[0]
                    diceresult = diceArray[0]
                    for (let index = 1; index < diceArray.length; index++) {
                        diceroll += " + " + diceArray[index]
                        diceresult += diceArray[index]
                        
                    }
                    if (diceArray.length == 1) {
                        msg.channel.send("Roll Result: __**"+diceresult+"**__")

                    } else {
                        msg.channel.send("Roll Result: __**"+diceresult+"**__ = "+diceroll)
                    } 
                }
            }
            
        //Switch Cases
        } else if (text.toLowerCase().split(' ')[0] == "!sc") {
            console.log(msg.author.tag +": "+ text) //messsagelog to server
            switch(text.split(' ')[1]) {
                //msg.channel.send(""); //for the lazy
                //Help Command
                case "help":
                        var fs = require('fs');            
                        msg.channel.send(fs.readFileSync('features.txt').toString());
                    break;
                //UA Command
                case "ua":
                        msg.channel.send("Here is the Ultimate Apocalypse download page :) https://www.moddb.com/mods/ultimate-apocalypse-mod/downloads");
                    break;
                //Suggest
                case "suggest":
                        pool.getConnection(function(err) {
                            if (err) throw err;
                            console.log("Connected to the Database!");
                            var sql = "INSERT INTO suggestions (username, message) VALUES ?";
                            var values = [
                                [msg.author.tag, (text.split('!sc ')[1].toString())],
                            ];
                            pool.query(sql, [values], function (err, result) {
                                if (err) throw err;
                                console.log("Inserted suggestion to database");
                                msg.channel.send("Your suggestion has been added");
                            });
                        });
                    break;
                default:
                    msg.channel.send("This command doesn't exist to find more commands type **!sc help**");
                    console.log(msg.author.tag +" **Failed at using** : "+ text) //messsagelog to server
              } 
        }
});client.login('');