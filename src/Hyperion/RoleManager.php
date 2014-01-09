<?php
namespace Hyperion;

/**
 * Class RoleManager
 *
 * @package Hyperion
 */
class RoleManager
{
    /**
     * Roles
     *
     * @var array
     */
    private $roles = [];

    /**
     * Create a RoleManager
     *
     * @param array func_get_args() Roles
     */
    public function __construct()
    {
        $roles = func_get_args();
        $roleCount = count($roles);
        $superRole = 0;

        for ($i = 0; $i < $roleCount; $i++) {
            $role = 1 << $i;
            $superRole += $role;

            $this->roles[$roles[$i]] = $role;
        }
        $this->roles['Super'] = $superRole;
    }

    /**
     * Add new role
     *
     * @param string $name Role name
     * @param int $value Role value
     */
    public function addRole($name, $value)
    {
        $this->roles[$name] = $value;
    }

    /**
     * List all roles
     *
     * @return array
     */
    public function listRoles()
    {
        return array_flip($this->roles);
    }

    /**
     * Check is $sRole in $role
     *
     * @param int $sRole Role value
     * @param string $role Role name
     * @return bool
     */
    public function isInRole($sRole, $role)
    {
        $role = $this->roles[$role];
        return ($sRole & $role) == $role;
    }

    /**
     * Check is $sRole in $roles
     *
     * @param int $sRole Role value
     * @param array $roles Role names
     * @return bool
     */
    public function isInRoles($sRole, $roles)
    {
        foreach ($roles as $role)
            if (!$this->isInRole($sRole, $role))
                return false;
        return true;
    }

    /**
     * Get role value
     * @param array func_get_args() Role names
     * @return int Role value
     */
    public function getRole()
    {
        $roles = func_get_args();
        $rRole = 0;
        foreach ($roles as $role)
            $rRole += $this->roles[$role];

        return $rRole;
    }
} 