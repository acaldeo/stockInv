<?php
 	
      $id = $_GET['id'];
	  require('fpdf.php');

	  
		//$remitos = find_detalle_remito('sales',(int)$_GET['id']);
		$mysqli=new mysqli("localhost","root","gine","oswa_inv");
		$resultado = $mysqli->query("SELECT id_remito, product, qty from sales where id_remito = '$id'");	
	 
		//$r = $mysqli->query("select  fecha, monto from  caja_diaria where idcaja = '$id'");	
		
		

	  //$pdf->Image('logo2.png',10,8,50);
	  class pdf extends FPDF
	  {
	  	
	  	public function header()
	  	{
	  		$this->SetFont('Arial','B',20);
	  		$this->Ln();
			
			$this->Ln(10);
			//$this->Cell (0,0,'CEJUPEBA',0,2,'L');
			$this->Write (5,'Remito de Salida');
			$this->SetFont('Arial','',10);
			$this->Ln();
			$this->SetTextColor(61,174,233);
			//$this->Cell (0,10,'Anchorena 724 - Baradero - Bs. As.',0,2,'L'); 
			$this->Write (5,'Direccion: - Baradero - Bs. As.');
			$this->Ln();
			$this->Write (5,'Tel: '); 
			//$this->Cell (0,1,'Tel: 03329-15605094',0,2,'L');
			$this->Ln(10);

	  	}
	  	public function footer()
	  	{
	  		// Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	  	}
	}
	  $fpdf=new pdf();
	  $fpdf->AliasNbPages();
	  $fpdf->AddPage('P', 'A4');
	  $fpdf->Ln(10);
	  $fpdf->SetFont('Arial','B',14); 
	  $fpdf->Cell(0,5,'Detalle Remito de salida',0,0,'C');
	  $fpdf->SetFontSize(10);
	  $fpdf->SetFillColor(255,255,255);
	  $fpdf->SetTextColor(40,40,40);
	  $fpdf->SetDrawColor(88,88,88);
	  $fpdf->Ln(10);
	  $fpdf->Cell(45,10,'ITEM',0,0,'C',1); 
	  $fpdf->Cell(100,10,'PRODUCTO',0,0,'C',1);
	  $fpdf->Cell(45,10,'CANTIDAD',0,1,'C',1);
	  $fpdf->SetDrawColor(61,174,233);
	  $fpdf->SetLineWidth(1);
	  $fpdf->Line(10,68,199,68);
	  
	  $fpdf->SetLineWidth(0.2);	
	  $fpdf->SetFillColor(240,240,240);
	  $fpdf->SetTextColor(40,40,40);
	  $fpdf->SetDrawColor(255,255,255);	
	  $fpdf->Ln(0.3);
			//         ancho,altura
	  $fpdf->SetFont('Arial','',8);
	  $item = 1;
	  while($registro = mysqli_fetch_array($resultado))	
		{	
			  $fpdf->Cell(45,6,$item,1,0,'C',1);
			  $fpdf->Cell(100,6,$registro[1],1,0,'C',1);
			  $fpdf->Cell(45,6,$registro[2],1,0,'C',1);
			  
			  $item = $item + 1;
		} 
	  	


		  //$pdf->Output('F', '/home/c16292/public_html/detailing/presupuestos/Presupuesto.pdf');
		$fpdf->Output();
	
	mysql_close;
	  
?>
