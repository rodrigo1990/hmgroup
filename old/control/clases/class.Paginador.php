<?php
class Paginador{
	
	var $totalItems;
	var $paginaActual;
	var $paginaSiguiente;
	var $paginaAnterior;
	var $cantidadPaginas;
	var $primeraPagina;
	var $ultimaPagina;
	var $paginado;
	
	function Paginador($paginado=null,$totalItems=null,$paginaActual=0){
		if(is_null($paginado) || is_null($totalItems)){
			return true;
		}
		
		$this->totalItems=$totalItems;
		$this->paginado=$paginado;
		$this->paginaActual=$paginaActual;
		$this->calcular();
	}
	
	function calcularPaginacion($paginado,$totalItems,$paginaActual=0){
		
		$this->totalItems=$totalItems;
		$this->paginado=$paginado;
		$this->paginaActual=$paginaActual;
		
		
		//Calculo Primera Pagina
		$this->primeraPagina=0;
		
		//Calculo Cant de Paginas
		$this->cantidadPaginas=ceil($this->totalItems/$this->paginado);
		
		//Calculo Ultima Pagina
		$this->ultimaPagina=$this->cantidadPaginas-1;
		
		//Calculo Proxima Pagina
		$this->paginaSiguiente=false;
		if(($this->paginaActual+$this->paginado)<$this->totalItems){
			$this->paginaSiguiente=$this->paginaActual+$this->paginado;
		}
		
		//Calculo Pagina Anterior
		$this->paginaAnterior=false;
		if(($this->paginaActual-$this->paginado)>=0){
			$this->paginaAnterior=$this->paginaActual-$this->paginado;
		}
		
	}
	
	
}
?>