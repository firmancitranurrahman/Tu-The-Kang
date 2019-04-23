<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_tukang extends CI_Model{
    private $_table = "tukang";
    public $id;
    public $nama;
    public $jenis_kelamin;
    public $tanggal_lahir;
    public $umur;
    public $email;
    public $password; 
    public $foto="default.jpg";

    public function rules(){
        return [
            ['field'=>'nama',
            'label'=>'Nama',
            'rules'=>'required'
            ],
            ['field'=>'umur',
             'label'=>'Umur',
             'rules'=>'required'];
        ]
    }
    public function getAll(){
        return $this->db->get($this->_table)->result();
    }
    public function getById($id){
        return $this->db->get_where($this->_table, ["id"=>$id])->row();
    }
    public function save(){
        $post=$this->input->post();
        $this->id = $post["id"];
        $this->nama= $post["nama"];
        $this->jenis_kelamin=$post["jenis_kelamin"];
        $this->tanggal_lahir=$post["tanggal_lahir"];
        $this->umur= $post["umur"];
        $this->email=$post["email"];
        $this->password=$post["password"];
        $this->foto= $this -> _uploadImage();
     
        $this->db->insert($this->_table , $this) ;
        
    }

    public function update(){
        $post= $this ->input ->post();
        $this->id = $post["id"];
        $this->nama= $post["nama"];
        $this->jenis_kelamin=$post["jenis_kelamin"];
        $this->tanggal_lahir=$post["tanggal_lahir"];
        $this->umur= $post["umur"];
        $this->email=$post["email"];
        $this->password=$post["password"];
        $this->foto= $this -> _uploadImage();
        
        if (!empty($_FILES["foto"]["name"])) {
            $this->foto = $this->_uploadImage();
        } else {
            $this->foto = $post["old_image"];
        }

        $this->db->update($this->_table, $this, array("id"=>$post['id']));
    }
    public function delete($id){
        return $this->db->delete($this->_table,array("id"=>$id));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './foto/tukang';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->nama;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    private function _deleteImage($id)
    {
        $img = $this->getById($id);
        if ($img->foto != "default.jpg") {
            $filename = explode(".", $img->foto)[0];
            return array_map('unlink', glob(FCPATH . "foto/tukang/$filename.*"));
        }
    }
}
