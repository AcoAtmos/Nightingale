<?php

// menerima data (batasan list yang harus di tampilkan)
function capture_data(){
    $json = file_get_contents('php://input');
    $data = json_decode($json,1);
    return $data;
};

// connect DB and Query untuk list pasien
function connect_db_query_list($data){
    // data DB
    
    $con= connect_db();
    
    // $page = $data['page'];
    $limit = $data['limit'];
    
    // sytax sql  
    $sql = "select * from data_pasien limit $limit";
    
    $query = mysqli_query($con,$sql);
    
    while ($row=mysqli_fetch_assoc($query)){
        $data_db[]=$row;
    }
    
    if ($query){
        $response['status']='sucsess';
        $response['data']= $data_db;
        http_response_code(200);
    
    }else{
        $response ['status']='gagal';
        $response['message']='data gagal di simpan';
        http_response_code(500);
        
    }
    
    echo json_encode($response);
    mysqli_close($con);
};

// validasi data 
function validasi_data($data) {
    $errors = [];

    if (!isset($data['nama']) || trim($data['nama']) === '') {
        $errors[] = "Nama wajib diisi";
    }

    if (!isset($data['no_telp']) || trim($data['no_telp']) === '') {
        $errors[] = "No telp wajib diisi";
    }

    if (!isset($data['tanggal_lahir']) || trim($data['tanggal_lahir']) === '') {
        $errors[] = "Tanggal lahir wajib diisi";
    }

    if (!isset($data['alamat']) || trim($data['alamat']) === '') {
        $errors[] = "Alamat wajib diisi";
    }

    if (!empty($errors)) {
        return implode("\n", $errors); // gabungkan jadi string
    }

    return null; // tidak ada error
}

// connect db dan Query untuk save
function connect_db_query_save($data){
    $err = validasi_data($data);

    if ($err){
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $err
        ]);
        exit;
    };

    $con = connect_db();

    $nama          = $data['nama'];
    $no_telp       = $data['no_telp'];
    $tgl_lahir     = $data['tanggal_lahir'];
    $alamat        = $data['alamat'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $id            = $data['id'];

    if($id == ''){
        $sql = "INSERT INTO data_pasien(nama,tanggal_lahir,no_telp,jenis_kelamin,alamat) 
                VALUES('$nama','$tgl_lahir','$no_telp','$jenis_kelamin','$alamat')";
    }else{
        $sql = "UPDATE data_pasien 
                SET nama='$nama', tanggal_lahir='$tgl_lahir', no_telp='$no_telp',
                    jenis_kelamin='$jenis_kelamin', alamat='$alamat'
                WHERE id='$id'";
    }

    if(mysqli_query($con,$sql)){
        http_response_code(200);
        echo json_encode(['status'=>'success','message'=>'Data tersimpan']);
    } else {
        http_response_code(500);
        echo json_encode(['status'=>'error','message'=>'Gagal menyimpan data']);
    }

    mysqli_close($con);
}

function delete_data_pasien(){
    ob_clean(); // hapus output sampah
    header('Content-Type: application/json');

    // capture payload
    $id = $_GET['delete_pasien'];
    
    // validasi data
    if($id == '' || $id == null || $id == 'undefined'){
        $response['status'] = 'failed';
        $response['message'] = 'id kosong';
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // cek karakter berbahaya
    if(
        strpos($id, "'") !== false ||
        strpos($id, "--") !== false ||
        strpos($id, '"') !== false
    ){
        $response['status'] = 'failed';
        $response['message'] = 'id tidak valid';
        http_response_code(500);
        echo json_encode($response);
        exit;
    }

    // koneksi db
    $con = connect_db();

    // query hapus
    $sql = "DELETE FROM data_pasien WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query){
        $response['status'] = 'success';
        $response['message'] = 'data berhasil dihapus';
        http_response_code(200);
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'data gagal dihapus';
        http_response_code(500);
    }

    mysqli_close($con);

    // output JSON bersih
    echo json_encode($response);
    exit;
}