# SeAdventures
Servizio di noleggio imbarcazioni e moto d'acqua

=========

## Indice

- [Descrizione](#descrizione)
- [Installazione](#installazione)
- [MailHog](#mailhog)
- [Licenza](#licenza)

## Descrizione

Il progetto SeAdventures è il frutto del mio progetto realizzato per l'esame di SISTEMI WEB E BASI DI DATI. 

## Installazione

Segui questi passaggi per installare e configurare il progetto:

  * [Scarica l'ultima versione di XAMPP](https://www.apachefriends.org/download.html).
  * Estrai la cartella htdocs e copia l'intero contenuto nella cartella _C:\xampp\htdocs_
  * Aprire _XAMPP_ e avviare i servizi _Apache_ e _MySQL_.
  * Aprire il browser e digitare nella barra degli indirizzi http://localhost/phpmyadmin per 
    accedere all'interfaccia grafica di _PHPMyAdmin_.
  * Selezionare _Importa_ e importare il dump _seadventures.sql_ per creare e popolare il database.
  * Vedi la sezione _MailHog_ per configurare l'invio di e-mail da parte della piattaforma (opzionale).
  * Una volta predisposto il database si può digitare nella barra degli indirizzi http://localhost per accedere alla piattaforma web del progetto.

## MailHog

* [Scarica MailHog da GitHub](https://github.com/mailhog/MailHog/releases/v1.0.0) o, in alternativa, nella cartella del progetto c'è una sottocartella con l'eseguibile pronto.
*   Configura _XAMPP_ 
    * Modificare il file _C:\xampp\php\php.ini_ o in alternativa sostituire il file già presente nella cartella con quello fornito da me.
    
    * Per la modifica bisogna cercare nel file la sezione 
    ```
    [mail function]
    ```
    e sostituire
    ```
    smtp_port=25
    ```
    con
    ```
    smtp_port=1025
    ```
    e assicurarsi che sia impostato il parametro
    ```
    SMTP=localhost
    ```
* Dopo aver effettuato le modifiche, avviare l'eseguibile di MailHog precedentemente scaricato.
* Aprire il browser all'indirizzo http://localhost:8025/ per visualizzare l'interfaccia grafica di MailHog, dove verranno intercettate le mail inviate dalla piattaforma.
    

### Licenza
Copyright ©‎ 2022, Giuseppe d'Aniello

Rilasciato sotto licenza MIT, vedi [LICENSE](LICENSE.md) per i dettagli.

