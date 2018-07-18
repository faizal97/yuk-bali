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
						<th>No</th>
						<th>Nama Lengkap</th>
						<th>Materi</th>
						<th>Nilai</th>
                        </tr>';
                  foreach($data_kursus->result() as $row){
					$id_materi = $row->id_materi;
					$query = $this->db->query("SELECT * FROM tb_materi WHERE id_materi='$id_materi'");
					$query = $query->row();
					$nama_materi = $query->nama_materi;
					  $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
							<td>'.$row->nama_depan." ".$row->nama_belakang.'</td>
							<td>'.$nama_materi.'</td>
							<td>'.$row->nilai.'</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('laporan_pelajar.pdf', 'I');
?>
