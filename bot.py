#!/usr/bin/env python3

import telegram
import cgi
import cgitb
cgitb.enable()

# Ваш токен бота
BOT_TOKEN = 'AAHX5lIBOlpN3dA4XVApH6pqTC408YNoCNE'
CHAT_ID = '6486611753'

def send_telegram_message(message):
    bot = telegram.Bot(token=BOT_TOKEN)
    bot.send_message(chat_id=CHAT_ID, text=message)

# Получаем данные формы
form = cgi.FieldStorage()
name = form.getvalue("name")
email = form.getvalue("email")
message = form.getvalue("message")

if name and email and message:
    telegram_message = f"Имя: {name}\nEmail: {email}\nСообщение: {message}"
    send_telegram_message(telegram_message)
    print("Content-Type: text/plain")
    print()
    print("Спасибо! Ваше сообщение было отправлено.")
else:
    print("Content-Type: text/plain")
    print()
    print("Пожалуйста, заполните все поля формы и попробуйте снова.")
