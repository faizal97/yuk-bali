<?php
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Laporan Pelajar');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true,30);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

// add a page
            $pdf->AddPage();
            $i=0;
                $html=' 
                <h3 style="font-size:20pt;text-align:center;">Laporan Pelajar</h3>
                    <table cellspacing="2" bgcolor="black" cellpadding="4">
                        <tr bgcolor="#ffffff">
						<th width="20%">No</th>
						<th width="50%">Nama Lengkap</th>
						<th width="30%">Materi Terakhir</th>
                        </tr>';
                  foreach($data_kursus->result() as $row){
					  $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
							<td>'.$row->nama_depan." ".$row->nama_belakang.'</td>
							<td>'.$row->materi_terakhir.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('laporan_pelajar.pdf', 'I');
?>
