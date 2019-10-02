<?php
/**
 * Created by PhpStorm.
 * User: BahaEddine
 * Date: 23-Feb-19
 * Time: 12:55 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Expert
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 */
class Admin extends User
{

}