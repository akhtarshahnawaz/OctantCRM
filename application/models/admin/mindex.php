<?php

class Mindex extends  CI_Model
{

    function __construct(){
        parent::__construct();
    }

    public function index(){
        $result=array();
        $result['Customers']=$this->db->count_all('od-customers');
        $result['Leads']=$this->db->count_all('od-leads');
        $result['Users']=$this->db->count_all('od-login');

        $this->db->where('order-status','Active');
        $this->db->from('od-customer-orders');
        $result['Active Orders']=$this->db->count_all_results();

        $this->db->where('od-trash',1);
        $this->db->from('od-customers');
        $result['Trash Customers']=$this->db->count_all_results();

        $this->db->where('od-trash',1);
        $this->db->from('od-leads');
        $result['Trash Contacts']=$this->db->count_all_results();
        return $result;
    }

    public function install($data){
        $this->load->helper('url');
        $this->load->library('session');

        $error=false;
        $msg='';
        if($data['password']=="" || $data['verifyPassword']=="" || $data['username']=""){
            $error=true;
            $msg="Make sure all fields are filled ! </br>";
        }
        if($data['password']!=$data['verifyPassword']){
            $error=true;
            $msg.="Password Not Matching!";
        }
            if(!$error){
                $this->db->where('od-username',$data['inputUsername']);
                $query=$this->db->get('od-login');
                $result=$query->result_array();
                if(!empty($result)){
                    $this->session->set_flashdata('notification','This username is already taken!');
                    $this->session->set_flashdata('alertType', 'alert-error');
                    redirect('index/install', 'refresh');
                }else{
                    $insertuser=array(
                        'od-username'=>$data['inputUsername'],
                        'od-password'=>sha1($data['password']),
                        'od-account-type'=>'SuperUser'
                    );
                    $this->db->insert('od-login',$insertuser);
                    if($this->db->affected_rows()>0){
                        $this->session->set_flashdata('notification','Successfully Installed');
                        $this->session->set_flashdata('alertType', 'alert-success');
                        redirect('index/login', 'refresh');
                    }else{
                        $this->session->set_flashdata('notification','Unknown error');
                        $this->session->set_flashdata('alertType', 'alert-error');
                        redirect('index/install', 'refresh');
                    }
                }

            }else{
                $this->session->set_flashdata('notification',$msg);
                $this->session->set_flashdata('alertType', 'alert-error');
                redirect('index/install', 'refresh');
            }
    }


    public function checkInstall(){
            $query=$this->db->get('od-login');
            $result=$query->result_array();
            if(empty($result)){
                return true;
            }else{
                return false;
            }
    }





    public function getSchema($database){
        $query="SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `".$database."` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `".$database."` ;

-- -----------------------------------------------------
-- Table `".$database."`.`od-login`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-login` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `od-username` VARCHAR(100) NULL ,
  `od-password` VARCHAR(100) NULL ,
  `od-account-type` VARCHAR(100) NULL ,
  PRIMARY KEY (`pkey`) ,
  UNIQUE INDEX `od-username_UNIQUE` (`od-username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customers` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `od-firstname` VARCHAR(45) NULL ,
  `od-lastname` VARCHAR(45) NULL ,
  `od-company` VARCHAR(45) NULL ,
  `od-designation` VARCHAR(45) NULL ,
  `od-trash` VARCHAR(45) NULL ,
  `od-files` VARCHAR(256) NULL ,
  `owner` VARCHAR(45) NULL ,
  PRIMARY KEY (`pkey`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customer-meta-group`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customer-meta-group` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `fkey-customer-meta-group` INT NOT NULL ,
  `od-meta-category` TEXT NULL ,
  PRIMARY KEY (`pkey`) ,
  INDEX `fkey-customer-meta-group_idx` (`fkey-customer-meta-group` ASC) ,
  CONSTRAINT `fkey-customer-meta-group`
    FOREIGN KEY (`fkey-customer-meta-group` )
    REFERENCES `".$database."`.`od-customers` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customer-meta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customer-meta` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `fkey-meta-group` INT NOT NULL ,
  `od-meta-key` TEXT NULL ,
  `od-meta-value` TEXT NULL ,
  PRIMARY KEY (`pkey`) ,
  INDEX `fkey-meta-group_idx` (`fkey-meta-group` ASC) ,
  CONSTRAINT `fkey-meta-group`
    FOREIGN KEY (`fkey-meta-group` )
    REFERENCES `".$database."`.`od-customer-meta-group` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customer-orders`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customer-orders` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `fkey-customer-orders` INT NOT NULL ,
  `order-type` TEXT NULL ,
  `order-amount` VARCHAR(45) NULL ,
  `order-status` VARCHAR(45) NULL ,
  `order-start-date` VARCHAR(45) NULL ,
  `order-end-date` VARCHAR(45) NULL ,
  `currency` VARCHAR(45) NULL ,
  `comment` TEXT NULL ,
  `charged` INT NULL ,
  PRIMARY KEY (`pkey`) ,
  INDEX `customer-key_idx` (`fkey-customer-orders` ASC) ,
  CONSTRAINT `fkey-customer-orders`
    FOREIGN KEY (`fkey-customer-orders` )
    REFERENCES `".$database."`.`od-customers` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customer-payment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customer-payment` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `fkey-customer-payment` INT NOT NULL ,
  `date` VARCHAR(45) NULL ,
  `od-amount` VARCHAR(45) NULL ,
  `payment-method` VARCHAR(45) NULL ,
  `type` TEXT NULL ,
  `comment` TEXT NULL ,
  `currency` VARCHAR(45) NULL ,
  `fkey-order-id` INT NULL ,
  PRIMARY KEY (`pkey`) ,
  INDEX `customer-key_idx` (`fkey-customer-payment` ASC) ,
  INDEX `fkey-order-id_idx` (`fkey-order-id` ASC) ,
  CONSTRAINT `fkey-customer-payment`
    FOREIGN KEY (`fkey-customer-payment` )
    REFERENCES `".$database."`.`od-customers` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fkey-order-id`
    FOREIGN KEY (`fkey-order-id` )
    REFERENCES `".$database."`.`od-customer-orders` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-leads`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-leads` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `od-firstname` VARCHAR(45) NULL ,
  `od-lastname` VARCHAR(45) NULL ,
  `od-company` VARCHAR(45) NULL ,
  `od-designation` VARCHAR(45) NULL ,
  `od-email` TEXT NULL ,
  `od-website` TEXT NULL ,
  `od-phone` VARCHAR(45) NULL ,
  `od-address` TEXT NULL ,
  `od-trash` VARCHAR(45) NULL ,
  `details` TEXT NULL ,
  `status` VARCHAR(45) NULL ,
  `owner` VARCHAR(45) NULL ,
  PRIMARY KEY (`pkey`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-customer-contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-customer-contact` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `fkey-customer-contact` INT NOT NULL ,
  `emailp` TEXT NULL ,
  `emails` TEXT NULL ,
  `phonep` VARCHAR(45) NULL ,
  `phones` VARCHAR(45) NULL ,
  `address` TEXT NULL ,
  `website` TEXT NULL ,
  PRIMARY KEY (`pkey`) ,
  INDEX `fkey-customer-contact_idx` (`fkey-customer-contact` ASC) ,
  CONSTRAINT `fkey-customer-contact`
    FOREIGN KEY (`fkey-customer-contact` )
    REFERENCES `".$database."`.`od-customers` (`pkey` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `".$database."`.`od-email`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `".$database."`.`od-email` (
  `pkey` INT NOT NULL AUTO_INCREMENT ,
  `from` TEXT NULL ,
  `to` TEXT NULL ,
  `subject` TEXT NULL ,
  `message` TEXT NULL ,
  PRIMARY KEY (`pkey`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
";
        return $query;
    }


}
