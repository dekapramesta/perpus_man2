<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilePerpus extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('role_id') != 70) {
            redirect('');
        }
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data['profile'] = $this->db->get_where('profile_perpus', array('id_profile' => 77))->row();
        $this->load->view('Admin/templates/header');
        $this->load->view('Admin/templates/sidebar_su');
        $this->load->view('Admin/profile_perpus', $data);
        $this->load->view('Admin/templates/footer');
    }
    public function UpdateProfile()
    {
        # code...
        $data_update = array(
            'nama_sekolah' => $this->input->post('nama_sekolah'),
            'alamat' => $this->input->post('alamat'),
            'profile' => $this->input->post('profile'),
            'kordinat_gmaps' => $this->input->post('kordinat_gmaps'),
            'token_wa' => $this->input->post('token_wa'),

        );
        $where = array(
            'id_profile' => 77
        );
        $this->Model_admin->edit_data($where, $data_update, 'profile_perpus');
        $this->session->set_flashdata(
            'profile_su',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Data Berubah","success");</script>'
        );
        redirect('SuperAdmin/ProfilePerpus');
    }

    function UpdateFoto()
    {
        # code...

        $data = $this->db->get_where('profile_perpus', array('id_profile' => 77))->row();
        $old = './assets/img/' . $data->banner;
        unlink($old);
        $banner = $_FILES['banner']['name'];
        $new_name = time() . $_FILES['banner']['name'];
        if ($banner != null) {
            $config['file_name'] = $new_name;
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('banner')) {
                $banner = $this->upload->data('file_name');
            }
        }
        $data_edit = array(
            'banner' => $banner,
        );


        $where = array(
            'id_profile' => 77
        );
        $this->Model_admin->edit_data($where, $data_edit, 'profile_perpus');
        $this->session->set_flashdata(
            'profile_su',
            '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script type ="text/JavaScript">swal("Sukses","Data Berubah","success");</script>'
        );
        redirect('SuperAdmin/ProfilePerpus');
    }
}
