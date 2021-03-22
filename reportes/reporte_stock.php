<?php
 	
	$id = $_GET['id'];
	$id2 = $_GET['id2'];
	require('fpdf.php');
	
	$mysqli=new mysqli("localhost","root","gine","oswa_inv");
	
	if ($id != "" && $id2 == "") {
		$resultado = $mysqli->query("SELECT p.id,p.name,p.quantity,p.stock_min,p.media_id,p.date,c.name AS categorie,pr.nombre AS proveedor FROM products p LEFT JOIN categories c ON c.id = p.categorie_id LEFT JOIN media m ON m.id = p.media_id LEFT JOIN proveedores pr ON pr.id = p.proveedor_id where quantity < stock_min and proveedor_id = '$id'");
	}elseif($id2 != "" && $id = ""){
		$resultado = $mysqli->query("SELECT p.id,p.name,p.quantity,p.stock_min,p.media_id,p.date,c.name AS categorie,pr.nombre AS proveedor FROM products p LEFT JOIN categories c ON c.id = p.categorie_id LEFT JOIN media m ON m.id = p.media_id LEFT JOIN proveedores pr ON pr.id = p.proveedor_id where quantity < stock_min and stock_min = '$id'");

	}else{
		$resultado = $mysqli->query("SELECT p.id,p.name,p.quantity,p.stock_min,p.media_id,p.date,c.name AS categorie,pr.nombre AS proveedor FROM products p LEFT JOIN categories c ON c.id = p.categorie_id LEFT JOIN media m ON m.id = p.media_id LEFT JOIN proveedores pr ON pr.id = p.proveedor_id where quantity < stock_min ");
	}
	

		
		
	 class pdf extends FPDF
	  {
	  	
	  	public function header()
	  	{
	  		$this->SetFont('Arial','B',20);
	  		$this->Ln();
			
			$this->Ln(10);
			//$this->Cell (0,0,'CEJUPEBA',0,2,'L');
			$this->Write (5,'LISTADO STOCK');
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
	  $fpdf->Cell(0,5,'LISTADO STOCK',0,0,'C');
	  $fpdf->SetFontSize(10);
	  $fpdf->SetFillColor(255,255,255);
	  $fpdf->SetTextColor(40,40,40);
	  $fpdf->SetDrawColor(88,88,88);
	  $fpdf->Ln(10);
	  $fpdf->Cell(45,10,'DESCRIPCION',0,0,'C',1); 
	  $fpdf->Cell(45,10,'STOCK',0,0,'C',1);
	  $fpdf->Cell(45,10,'STOCK MINIMO',0,0,'C',1);
	  $fpdf->Cell(45,10,'PROVEEDOR',0,1,'C',1);
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
	  
	  while($registro = mysqli_fetch_array($resultado))	
		{	
			   
			  $fpdf->Cell(45,6,$registro[1],1,0,'C',1);
			  $fpdf->Cell(45,6,$registro[2],1,0,'C',1);
			  $fpdf->Cell(45,6,$registro[3],1,0,'C',1);
			  $fpdf->Cell(45,6,$registro['proveedor'],1,0,'C',1);


		} 
	  	


		  //$pdf->Output('F', '/home/c16292/public_html/detailing/presupuestos/Presupuesto.pdf');
		$fpdf->Output();
	
	mysql_close;
	  
?>
