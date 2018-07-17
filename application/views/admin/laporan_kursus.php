<?php
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Laporan Kursus');
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
                <h3 style="font-size:20pt;text-align:center;">Laporan Kursus</h3>
                    <table cellspacing="2" bgcolor="black" cellpadding="4">
                        <tr bgcolor="#ffffff">
                            <th width="5%" align="center">No</th>
							<th width="40%" align="center">Nama Kursus</th>
							<th width="20%" align="center">Kategori</th>
                            <th width="20%" align="center">Nama Pengajar</th>
                            <th width="15%" align="center">Jumlah Pelajar</th>
                        </tr>';
                  foreach($data_kursus->result() as $kursus){
					  $id_pengajar = $kursus->id_pengajar;
					  $id_kursus = $kursus->id_kursus;
					  $p = $this->db->query("SELECT * FROM tb_pengajar INNER JOIN tb_pelajar ON tb_pengajar.id_pelajar = tb_pelajar.id_pelajar WHERE tb_pengajar.id_pengajar='$id_pengajar'");
						$p = $p->row();
						$pel = $this->db->query("SELECT COUNT(tb_detail_kursus.id_detail_kursus) AS jumlah_pelajar FROM tb_detail_kursus WHERE id_kursus='$id_kursus'");
						$pel = $pel->row();
					  $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
							  <td>'.$kursus->nama_kursus.'</td>
							  <td>'.$kursus->nama_kategori.'</td>
                              <td>'.$p->nama_depan.' '.$p->nama_belakang.'</td>
                              <td>'.$pel->jumlah_pelajar.' Pelajar</td>
                        </tr>';
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('laporan_buku.pdf', 'I');
?>
