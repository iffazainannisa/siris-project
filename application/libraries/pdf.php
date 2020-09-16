<?php 

use Dompdf\Dompdf; 

Class Pdf extends Dompdf{
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($view, $data = array()){
       	$html = $this->ci()->load->view($view, $data, TRUE);
		$this->load_html($html);
		$this->render();
		$this->stream("qrcode_barang.pdf", array("Attachment" => false));
	}

    public function load_view2($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        $this->render();
        $this->stream("inventaris_ruang.pdf", array("Attachment" => false));
    }
    public function load_view3($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        $this->render();
        $this->stream("inventaris.pdf", array("Attachment" => false));
    }
}

?>