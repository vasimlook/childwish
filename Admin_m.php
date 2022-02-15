<?php

namespace App\Models\Madmin;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Admin_m extends Model {
    
    protected $db;
    protected $session;
    var $table = 'topup t';
    var $column_order = array(null,'ma.mobile', 't.topup_id', 't.amount', 't.refUser_id', 't.screen_shot', 't.upload_date', 't.status');
    var $column_search = array('ma.mobile','t.topup_id', 't.amount', 't.refUser_id', 't.screen_shot', 't.upload_date', 't.status');
    var $order = array('t.topup_id' => 'desc'); // default order 

    public function __construct() {
        $this->session = session();
        $this->db = db_connect();
        helper('functions');
    }

    public function _get_datatables_query($builder) {
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $builder->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $builder->like($item, $_POST['search']['value']);
                } else {
                    $builder->orLike($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $builder->groupEnd(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $builder->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $builder->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $builder = $this->db->table($this->table);
        $builder->select('t.*,ma.mobile');
        $builder->join('master_admin ma', 'ma.admin_id = t.refUser_id', 'left');        
        $this->_get_datatables_query($builder);
        if ($_POST['length'] != -1)
            $builder->limit($_POST['length'], $_POST['start']);
        $query = $builder->get();
        return $query->getResult();
    }

    function count_filtered() {
        $builder = $this->db->table($this->table);
        $builder->select('t.*,ma.mobile');
        $builder->join('master_admin ma', 'ma.admin_id = t.refUser_id', 'left');
        $this->_get_datatables_query($builder);
        return $builder->countAllResults();
    }

    public function count_all() {
        $builder = $this->db->table($this->table);
        $builder->select('t.*,ma.mobile');
        $builder->join('master_admin ma', 'ma.admin_id = t.refUser_id', 'left');
        return $builder->countAllResults();
    }
    
    
    public function update_topup($topup_id) {                
        
        $check = $this->db->query(" SELECT * FROM topup WHERE topup_id = '$topup_id' AND status=1 ");
        $row = $check->getRowArray();
        if (!empty($row)) {
            return false;
        }
        
        $params = [           
            'status'  => 1
        ];                     
        $builder = $this->db->table('topup');                        
        $builder->where('topup_id', $topup_id);
        $builder->where('status', 0);
        $builder->update($params);                       
                
        $check = $this->db->query(" SELECT * FROM topup WHERE topup_id = '$topup_id' AND status=1 ");
        $row = $check->getRowArray();
        if (!empty($row)) {
            return $row;
        }
        return false;                
    }
    public function update_wallet($amount,$refUserid) {                                             
        $result = $this->db->query("UPDATE wallet SET amount = $amount + amount WHERE refUser_id = '$refUserid' ");                                               
        return $result;
    }
}
