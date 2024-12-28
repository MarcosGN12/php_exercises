<?php
    class Pelicula {
        protected $nombre;
        protected $genero;
        protected $duracion;
        protected $puntuacion;
        protected $elenco;
    
        // setNombre
        public function setNombre($nombre) {
            $this->nombre = ucfirst($nombre);
        }
    
        // setGenero
        public function setGenero($genero) {
            $this->genero = ucfirst($genero);
        }
    
        // setDuracion 
        public function setDuracion($duracion) {
            $this->duracion = $duracion;
        }
    
        // setPuntuacion 
        public function setPuntuacion($puntuacion) {
            $this->puntuacion = $puntuacion;
        }
    
        // setElenco
        public function setElenco($elenco) {
            $this->elenco = $elenco;
        }
    
        // getNombre
        public function getNombre() {
            return $this->nombre;
        }
    
        // getGenero
        public function getGenero() {
            return $this->genero;
        }
    
        // getDuracion
        public function getDuracion() {
            return $this->duracion . " minutos";
        }
    
        // getPuntuacion
        public function getPuntuacion() {
            return $this->puntuacion . "/10 puntos en IMDb";
        }
    
        // getElenco
        public function getElenco() {
            return $this->elenco;
        }
    
        public function mostrarElenco() {
            // Inicializamos una variable para mostrar el resultado
            $elencoStr = "Elenco:<br>";
            // Aqui vamos a recorrer el array con el for para revisar cada posicion
            // y accederemos a ella segun su clave que es rol
                foreach ($this->elenco as $rol => $nombre) {
                    $elencoStr .= "$rol $nombre<br>";
                }
                // retornaremos esta variable que contiene todos los datos del array
                return $elencoStr;
            }
    }
    
    // Creación de instancia y asignación de valores usando setters
    $pelicula1 = new Pelicula();
    $pelicula1->setNombre("Dragon Ball Super: Broly");
    $pelicula1->setGenero("anime");
    $pelicula1->setDuracion(100);
    $pelicula1->setPuntuacion(7.7);
    $pelicula1->setElenco([
        "1.Nombre: " => "Tatsuya",
        "2.Apellido: " => "Nagamine",
        "3.Guionista: " => "Akira Toriyama",
        "4.Protagonista1: " => "Vic Mignogna",
        "5.Protagonista2: " => "Christopher Sabat"
    ]);
    
    echo "Nombre: " . $pelicula1->getNombre() . "<br>";
    echo "Género: " . $pelicula1->getGenero() . "<br>";
    echo "Duración: " . $pelicula1->getDuracion() . "<br>";
    echo "Puntuación: " . $pelicula1->getPuntuacion() . "<br>";
    echo $pelicula1->mostrarElenco();
    echo "<br>";
    
    // Repetir el mismo proceso para las demás películas
    $pelicula2 = new Pelicula();
    $pelicula2->setNombre("Dragon Ball Z: Un futuro diferente - Gohan y Trunks");
    $pelicula2->setGenero("anime");
    $pelicula2->setDuracion(47);
    $pelicula2->setPuntuacion(7.8);
    $pelicula2->setElenco([
        "1.Nombre: " => "Daisuke",
        "2.Apellido: " => "Nishio",
        "3.Guionista: " => "Akira Toriyama",
        "4.Protagonista1: " => "Vic Mignogna",
        "5.Protagonista2: " => "Christopher Sabat"
    ]);
    
    echo "Nombre: " . $pelicula2->getNombre() . "<br>";
    echo "Género: " . $pelicula2->getGenero() . "<br>";
    echo "Duración: " . $pelicula2->getDuracion() . "<br>";
    echo "Puntuación: " . $pelicula2->getPuntuacion() . "<br>";
    echo $pelicula2->mostrarElenco();
    echo "<br>";
    
    $pelicula3 = new Pelicula();
    $pelicula3->setNombre("Dragon Ball Z: El último combate");
    $pelicula3->setGenero("anime");
    $pelicula3->setDuracion(48);
    $pelicula3->setPuntuacion(7.8);
    $pelicula3->setElenco([
        "1.Nombre: " => "Mitsuo",
        "2.Apellido: " => "Hashimoto",
        "3.Guionista: " => "Akira Toriyama",
        "4.Protagonista1: " => "Vic Mignogna",
        "5.Protagonista2: " => "Christopher Sabat"
    ]);
    
    echo "Nombre: " . $pelicula3->getNombre() . "<br>";
    echo "Género: " . $pelicula3->getGenero() . "<br>";
    echo "Duración: " . $pelicula3->getDuracion() . "<br>";
    echo "Puntuación: " . $pelicula3->getPuntuacion() . "<br>";
    echo $pelicula3->mostrarElenco();
    echo "<br>";

    class PeliculaCons extends Pelicula{
        private $miPunt;

        public function __construct($nombre,$genero,$duracion,$puntuacion,$elenco,$miPunt){
            $this->nombre = $nombre;
            $this->genero = $genero;
            $this->duracion = $duracion;
            $this->puntuacion = $puntuacion;
            $this->elenco = $elenco;
            $this->mostrarElenco();
            $this->miPunt = $miPunt;
        }

        public function setMiPunt($miPunt){
            $this->miPunt = $miPunt;
        }

        public function getMiPunt(){
            return $this->miPunt . "/10 puntos";
        }

        public function __toString(){
            return "Nombre: " . $this->getNombre() . "<br> Género: " . $this->getGenero() . "<br> Duración: " . $this->getDuracion() . "<br> Puntuación: " . $this->getPuntuacion() . "<br>" . $this->getMiPunt() . "<br>" .  $this->mostrarElenco();  
        }
    }

    $pelicula4 = new PeliculaCons(
        "Dragon ball: La película - Comienza la magia",
        "anime",
        86,
        4.3,
        [
            "1.Nombre: " => "Chun-Liang",
            "2.Apellido: " => "Chen",
            "3.Guionista: " => "Akira Toriyama",
            "4.Protagonista1: " => "Vic Mignogna",
            "5.Protagonista2: " => "Christopher Sabat"
        ],
        2.3
    );
    
    echo $pelicula4;
    echo "<br>";

    $pelicula5 = new PeliculaCons(
        "Dragon Ball Z: Estalla el Duelo",
        "anime",
        72,
        7.4,
        [
        "1.Nombre: " => "Shigeyasu",
        "2.Apellido: " => "Yamauchi",
        "3.Guionista: " => "Akira Toriyama",
        "4.Protagonista1: " => "Vic Mignogna",
        "5.Protagonista2: " => "Christopher Sabat"
        ],
        5
    );
    
    echo $pelicula5;
    echo "<br>";

    abstract class Entretenimiento{
        protected $titulo;
        protected $genero;
        protected $puntuacion;
        protected static $tipoDeEntretenimiento;

        // constructor abstracto y publico
        abstract public function __construct($titulo,$genero,$puntuacion,$tipoDeEntretenimiento);
        // metodo toString abstracto y publico
        abstract public function __toString();

        public function Imprimir(){
            echo $this->__toString();
        }

        public function setPrecio($titulo){
            $this->titulo = $titulo;
        }

        public function setGenero($genero){
            $this->genero = $genero;
        }

        public function setPuntuacion($puntuacion){
            $this->puntuacion = $puntuacion;
        }

        public function setTipoDeEntretenimiento($tipoDeEntretenimiento){
            self::$tipoDeEntretenimiento = $tipoDeEntretenimiento;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function getPuntuacion(){
            return $this->puntuacion;
        }

        public function getTipoDeEntrenamiento(){
            return self::$tipoDeEntretenimiento;
        }
        
    }

    class Videojuego extends Entretenimiento{
        private $precio;
        private $tipo;

        public function __construct($titulo,$genero,$puntuacion,$precio = 0,$tipo = 0,$tipoDeEntretenimiento = 0){
            $this->titulo = $titulo;
            $this->genero = $genero;
            $this->puntuacion = $puntuacion;
            $this->precio = $precio;
            $this->tipo = $tipo;
            self::$tipoDeEntretenimiento = $tipoDeEntretenimiento;
        }

        public function __toString(){
            return "<br> Título: " . $this->titulo . "<br> Genero: " . $this->genero . "<br> Puntuación: " . $this->puntuacion . "/10" ."<br> Precio: " . "$" . $this->precio . "<br> Tipo: " . $this->tipo . "<br>" . "Tipo de entretenimiento: " . self::$tipoDeEntretenimiento . "<br>";
        }

        public function setPrecio($precio) {
            $this->precio = $precio;
        }
    
        public function getPrecio() {
            return $this->precio;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
    
        public function getTipo() {
            return $this->tipo;
        }
    }

    $juego1 = new Videojuego("Dragon ball tenkaichi3","pelea",9,20,"accion","Videojuego");
    $juego1->Imprimir();

    $juego2 = new Videojuego("Dragon ball tenkaichi4","pelea",7,30,"accion","Videojuego");
    $juego2->Imprimir();

    $juego3 = new Videojuego("Dragon ball sparking zero","pelea",10,70,"accion","Videojuego");
    $juego3->Imprimir();

    class Deportes extends Entretenimiento{
        private $intensidad;
        private $tipo;
        //protected static $TipoDeEntretenemiento;

        public function __construct($titulo,$genero,$puntuacion,$intensidad = 0,$tipo = 0,$tipoDeEntretenimiento = 0){
            $this->titulo = $titulo;
            $this->genero = $genero;
            $this->puntuacion = $puntuacion;
            $this->intensidad = $intensidad;
            $this->tipo = $tipo;
            self::$tipoDeEntretenimiento = $tipoDeEntretenimiento;
        }

        public function __toString(){
            return "<br> Título: " . $this->titulo . "<br> Genero: " . $this->genero . "<br> Puntuación: " . $this->puntuacion . "/10" ."<br> intensidad: " . $this->intensidad . "<br> Tipo: " . $this->tipo . "<br>" . "Tipo de entretenimiento: " . self::$tipoDeEntretenimiento . "<br>";
        }

        public function setIntensidad($intensidad) {
            $this->intensidad = $intensidad;
        }
    
        public function getIntensidad() {
            return $this->intensidad;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
    
        public function getTipo() {
            return $this->tipo;
        }
    }

    $deporte1 = new Deportes("Futbol","contacto",9,"intensa","aire libre","Deportes");
    $deporte1->Imprimir();

    $deporte2 = new Deportes("gimnasio","pelea",7,"sencilla","dentro","Deportes");
    $deporte2->Imprimir();

    $deporte3 = new Deportes("tenis","pelea",10,"dura","aire libre","Deportes");
    $deporte3->Imprimir();

    class JuegosMesa extends Entretenimiento{
        private $intensidad;
        private $tipo;

        public function __construct($titulo,$genero,$puntuacion,$intensidad = 0,$tipo = 0,$tipoDeEntretenimiento = 0){
            $this->titulo = $titulo;
            $this->genero = $genero;
            $this->puntuacion = $puntuacion;
            $this->intensidad = $intensidad;
            $this->tipo = $tipo;
            self::$tipoDeEntretenimiento = $tipoDeEntretenimiento;
        }

        public function __toString(){
            return "<br> Título: " . $this->titulo . "<br> Genero: " . $this->genero . "<br> Puntuación: " . $this->puntuacion . "/10" ."<br> intensidad: ". $this->intensidad . "<br> Tipo: " . $this->tipo . "<br>" . "Tipo de entretenimiento: " . self::$tipoDeEntretenimiento . "<br>";
        }

        public function setIntensidad($intensidad) {
            $this->intensidad = $intensidad;
        }
    
        public function getIntensidad() {
            return $this->intensidad;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
    
        public function getTipo() {
            return $this->tipo;
        }
    }

    $deporte1 = new JuegosMesa("ajedrez","contacto",9,"pensar","interior","JuegosMesa");
    $deporte1->Imprimir();

    $deporte2 = new JuegosMesa("catan","pelea",7,"estrategia","interior","JuegosMesa");
    $deporte2->Imprimir();

    $deporte3 = new JuegosMesa("virus","pelea",10,"suerte","interior","JuegosMesa");
    $deporte3->Imprimir();
?>
