# Laravel/Vue App

## QUICK START
### Install Dependencies
composer install
### Install JS Dependencies
npm install
### Watch Files
npm run watch

##

#Zadanie
Je daný nasledujúci endpoint: https://fecko.org/php-test ktorý vracia JSON niekoľkých
stoviek objektov, z ktorých každý má nasledujúcu štruktúru:

{
    "id": 73945,
    "name": "sunt",
    "first": 43,
    "second": 14,
    "third": 27,
    "math": "-3 + (12 * 2) - 4 = 45",
    "created": "1992-09-18 13:53:58"
}

Vytvorte jednoduchú web aplikáciu ktorá zobrazuje single page, kde sa nachádzajú 4
buttony, z ktorých každý po kliknuti vykonáva jednu z nižšie uvedených úloh. Po kliknutí na
button sa JSON z endpointu stiahne, vykoná samotná úloha a zobrazí počet záznamov
ktoré vyhovujú úlohe a počet záznamov, ktoré úlohe nevyhovujú, pod počtami sa zobrazia
konkrétne záznamy ktoré zadaniu úlohy vyhovujů:

1. Úloha: nájdite objekty, ktorých name po reverzii (tzn. Otočenia čítania, zo slova
strom sa stáva morts) vytvára slová: laravel, envoyer.

2. Úloha: nájdite objekty, u ktorých vydelením first hodnoty pomocou second hodnoty
dostaneme hodnotu v third, a zároveň hotnota v third je deliteľná číslom 4 a zároveň
číslom 5 alebo 6

3. Úloha: Pomocou parametra created nájdite objekty, ktoré boli vytvorené v roku
2014, druhého dňa v mesiaci, o 21. hodine a 30tej sekunde.
4. Úloha: V parametri math sa nachádza string jednoduchého matematického príkladu
aj s výsledkom (napr. „(4 + 5 – (10 / 2)) / 2 = 4“). Tento príklad u daného objektu má
alebo nemá správny výsledok. Vypíšte všetky objekty ktoré majú matematicky
správny výsledok. Príklady môžu obsahovať nasledovné matematické znaky: +,-
,*,/,(,),=. A taktiež záporné čísla (znamienko je pri čísle bez medzery). Zátvorky môžu
byť vnorené. Pred a za každým operátorom je medzera. Pre vyriešenie úlohy by ste
nemali použiť funkciu eval.

Na spomínanej single page vždy zobrazujte taktiež nasledujúce informácie: IP adresu
užívateľa a čo najviac informácií o návštevníkovi dokážete zistiť (UserAgent, mobile/desktop
a pod.)
K spracovanej úlohe napíšte dokumentáciu ako ju je možné rozbehať, zdrojový kód
umiestnite na verejný Github repozitár. 
