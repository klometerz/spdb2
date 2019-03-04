SELECT 
tb_trans.no_trans,
tb_trans.tgl_trans,
a.nama_petani as nama_supplier, 
a.desa_petani as desa_supplier, 
a.rtrw_petani as rtrw_petani,
a.kode_petani as kode_petani,
b.nama_petani as nama_customer, 
tb_detail_trans.nama_item,
tb_detail_trans.uom,
tb_detail_trans.qty, 
tb_detail_trans.kode_produksi 
from tb_detail_trans inner JOIN
tb_trans on tb_detail_trans.id_trans = tb_trans.id_trans
inner join tb_po on tb_po.no_po = tb_trans.no_po 
inner join tb_petani as a on tb_trans.supplier = a.kode_petani
inner join tb_petani as b on tb_trans.customer = b.kode_petani
where tb_trans.no_po = 'PO NOMOR 3' and tb_trans.no_urut != '' order by tb_trans.no_trans