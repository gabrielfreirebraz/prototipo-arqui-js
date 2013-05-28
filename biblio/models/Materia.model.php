<?php
/**
 *
 */
/**
 *
 */
class MateriaModel {

    const PHP      = "php";
    const JS       = "js";
    const HTML_CSS = "html-css";

    public $id;
    public $url;
    public $titulo;
    public $resumo;
    public $keywords;
    public $nivel;
    public $secao;
    public $autor;
    public $dt_atualizacao;
    public $dt_criacao;
    public $ordem;

    /**
     *
     * @param type $id
     */
    function setId($id){
        $this->id = $id;
    }


    /**
     *
     * @param type $id
     */
    function carregar($id) {

        $this->setId($id);

        $sql = "SELECT * FROM materias WHERE id = {$this->id}";
        $obj = Conn::getConexao()->query($sql)->fetch(PDO::FETCH_OBJ);

        $this->id             = $obj->id;
        $this->url            = $obj->url;
        $this->titulo         = $obj->titulo;
        $this->resumo         = $obj->resumo;
        $this->keywords       = $obj->keywords;
        $this->nivel          = $obj->nivel;
        $this->secao          = $obj->secao;
        $this->autor          = $obj->autor;
        $this->dt_atualizacao = $obj->dt_atualizacao;
        $this->dt_criacao     = $obj->dt_criacao;
        $this->ordem          = $obj->ordem;
    }


    /**
     *
     * @param type $where
     * @return type
     */
    static function getObjects($where=null, $order=null) {

        $materias = array();

        $orderby = $order ? $order : "ORDER BY ordem ASC";

        $sql  = "SELECT * FROM materias $where $orderby";

        $stmt = Conn::getConexao()->query($sql);
        while( $materia = $stmt->fetch(PDO::FETCH_OBJ)  ){
//            $materia->dt_criacao     = $materia->dt_criacao;
//            $materia->dt_atualizacao = $materia->dt_atualizacao;
            $materias[] = $materia;
        }

        return $materias;

    }

    
    /**
     * 
     * @throws Exception
     */
    function validar(){
        if(!$this->id) throw new Exception("faltou-id");
        if(!$this->url) throw new Exception("faltou-url");
        if(!$this->titulo) throw new Exception("faltou-titulo");
        if(!$this->resumo) throw new Exception("faltou-resumo");
        if(!$this->keywords) throw new Exception("faltou-keywords");
        if(!$this->nivel) throw new Exception("faltou-nivel");
        if(!$this->secao) throw new Exception("faltou-seção");
        if(!$this->autor) throw new Exception("faltou-autor");
        if(!$this->dt_atualizacao) throw new Exception("faltou-dt_atualizacao");
        if(!$this->dt_criacao) throw new Exception("faltou-dt_criacao");
        if(!$this->ordem) throw new Exception("faltou-ordem");
    }
    
    
    /**
     *
     * @throws Exception
     */
    function inserir(){

        $sql = "INSERT INTO materias"
                ."(id, url, titulo, resumo, keywords, nivel, secao, autor, dt_atualizacao, dt_criacao, ordem)"
                ." VALUES( "
                ."'null', "
                ."'".$this->url."', "
                ."'".$this->titulo."' ,"
                ."'".$this->resumo."' ,"
                ."'".$this->keywords."', "
                ."'".$this->nivel."', "
                ."'".$this->secao."', "
                ."'".$this->autor."', "
                ."'".$this->dt_atualizacao."', "
                ."'".$this->dt_criacao."', "
                .$this->ordem.")";
        $result = Conn::getConexao()->query($sql);
        if(!$result){
            $err = Conn::getConexao()->errorInfo();
            throw new Exception($err[2], $err[1]);
        }

        $this->id = Conn::getConexao()->lastInsertId();

    }

    
    /**
     *
     * @throws Exception
     */
    function update(){
        $sql = "UPDATE materias "
                ."SET "
//                ."id = '".$this->id."', "
                ."url = '".$this->url."', "
                ."titulo = '".$this->titulo."' ,"
                ."resumo = '".$this->resumo."' ,"
                ."keywords = '".$this->keywords."', "
                ."nivel = '".$this->nivel."', "
                ."secao = '".$this->secao."', "
                ."autor = '".$this->autor."', "
                ."dt_atualizacao = '".$this->dt_atualizacao."', "
                ."dt_criacao = '".$this->dt_criacao."', "
                ."ordem = ".$this->ordem
                ." WHERE id = ".$this->id;

        $result = Conn::getConexao()->query($sql);
        if(!$result){
            $err = Conn::getConexao()->errorInfo();
            throw new Exception($err[2], $err[1]);
        }
    }


    /**
     *
     * @throws Exception
     */
    function deletar(){

        $sql = "DELETE FROM materias WHERE id = {$this->id} LIMIT 1";

        $result = Conn::getConexao()->query($sql);
        if(!$result){
            $err = Conn::getConexao()->errorInfo();
            throw new Exception($err[2], $err[1]);
        }
    }

}



/**
 * Teste
 */
//require "../Conn.class.php";
//$materia = new Materia();


//$materia->carregar(6);
//var_dump($materia);

//$arr_materias = $materia->getObjects();
//var_dump($arr_materias);

?>
