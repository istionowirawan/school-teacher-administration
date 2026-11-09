SELECT t1.nis, t1.nisn, t1.niy, t1.nama, concat(t1.kelas,".",t1.paralel) as kelas, t1.id_mapel, t1.namamapel, t1.tipe, x.nik_guru, (y.id) as id_guru, (y.nama) as nama_guru, t1.tahunajaran 
FROM (
	SELECT a.nis, f.nisn, f.niy, a.nama, b.kelas_id, g.kelas, g.paralel, c.id_mapel, (d.nama) as namamapel, d.tipe, (e.id_mapel) as mapelid, b.tahunajaran
	FROM ms_siswa a
	JOIN set_siswa_kelas b
	ON a.nis=b.nis
	JOIN ms_kelas g
	ON b.kelas_id=g.id
	JOIN set_mapel_guru c
	ON b.kelas_id=c.id_kelas
	JOIN ms_siswa_nisn f
	ON a.nis=f.nis
	JOIN ms_mapel d
	ON c.id_mapel=d.id
	LEFT JOIN (
		SELECT a.nis, b.id_mapel 
		FROM ms_siswa a
		LEFT JOIN set_siswa_mapil b
		ON a.nis=b.nis
		LEFT JOIN ms_siswa_nisn c
		ON a.nis=c.nis
		WHERE c.niy='17070002'
		AND b.tahunajaran='2017-2018'
	) e
	ON c.id_mapel=e.id_mapel
	WHERE f.niy='17070002'
	AND b.tahunajaran='2017-2018'
	) as t1
LEFT JOIN set_mapel_guru x
ON t1.id_mapel=x.id_mapel AND t1.kelas_id=x.id_kelas
JOIN ms_guru y
ON x.nik_guru=y.nik
WHERE t1.mapelid IS NOT NULL
OR t1.tipe='Akademik'



SELECT a.nik_guru, (d.nama) as nama_guru, a.id_mapel, (b.nama) as nama_mapel, a.id_kelas, GROUP_CONCAT(concat(c.kelas,".",c.paralel) SEPARATOR ',') as kelas, a.tahunajaran
FROM `set_mapel_guru` a
JOIN ms_mapel b
ON a.id_mapel=b.id
JOIN ms_kelas c
ON a.id_kelas=c.id
JOIN ms_guru d
ON a.nik_guru=d.nik
WHERE a.tahunajaran='2017-2018'
AND (a.id_mapel='69' OR a.id_mapel='70')
GROUP BY a.nik_guru