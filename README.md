- INFORMAZIONI

Questa Applicazione è stata creata utilizzando il framework LARAVEL.
Tecnologie utilizzate:
- PHP v.8
- JS
- HTML
- CSS e SASS
- LARAVEL MIX (Web-Pack)
- NPM 7.4.0
- COMPOSER 2.0.8


----------------------------------------------------------------------------------------------------------------------##########################################################


- CONFIGURAZIONE

Nel terminale dell'IDE dopo aver fatto il clone del progetto:
- composer install 
- npm install 
- php artisan key:generate
- php artisan serve
- php artisan storage:link            -------------> serve a creare un link tra la cartella storage e la cartella public

Nel Folder del Progetto:
1) Creare due cartelle 
- una con il nome csv nel percorso storage/app/public ----------> es: storage/app/public/csv
- l'altra con il nome new sempre in questo percorso    ------------> es: storage/app/public/new
- in modo da avere una affianco all'altra le cartelle dei file creati dal file upload (csv) e la cartella dei nuovi file csv pronti per il download (new)

2) Copiare il file .env.example, salvarlo come .env e editarlo per le configuazioni dell'app e del server locale. Nella voce 
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=    -------------> inserire qui il nome dello schema a cui vuoi collegarti oppure creane uno nuovo e scrivi qui il suo nome
- DB_USERNAME=root    -------------> inserire qui l'username nella connessione  
- DB_PASSWORD=    -------------> inserire qui la root password 

3) ora nel terminale scrivere:
- php artisan migrate  -------------> per creare le tabelle 

----------------------------------------------------------------------------------------------------------------------##########################################################

- APP

Web app per fare l'upload di un file csv, leggerlo e inizializzare i dati in un database (di default MySql) per poi creare dei file csv per il download, una API endpoint e una view html con le tabelle. Si creano perciò tre tabelle, una coi dati corretti, una con i dati revisionati e una con i dati scorretti. I dati sono stati valutati in base al numero di telefono del Sudafrica, in cui compaiono 11 cifre e il prefisso è il 27. Nel controller principale PhoneController ci sono dei parametri personalizzabili: il numero delle righe iniziali da scartare (per eventuale titolo) del file e il numero delle righe che si vogliono tenere per file, in base alla grandezza del file da gestire. Per lavori particolarmente grandi si consiglia di incrementare l'applicazione con Redis in modo da poter svolgere temporalmente le azioni sul database. Ho cercato di usare i Components e i Blade per una maggiore scalabilità del Progetto. Non è ancora stata implementata la vista Mobile e i media query del CSS. 

- Nella cartella del progetto si può trovare anche il testo della richiesta dell'esercizio.

