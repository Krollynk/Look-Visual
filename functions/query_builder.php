<?php
// core/ModelMapper.php
class ModelMapper {
    private static $map = [
        'SadmEstablecimientos' => [
            'table' => 'sadm_establecimientos',
            'fields' => [
                'estId' => 'sadm_est_id',
                'corId' => 'sadm_cor_id',
                'estRazon' => 'sadm_est_razon',
            ],
        ],
        'SadmTasasRetenciones' => [
            'table' => 'sadm_tasas_retenciones',
            'fields' => [
                'taretTipoTabla' => 'sadm_taret_tipo_tabla',
                'taretId' => 'sadm_taret_id',
            ],
        ],
        'SadmTasasRetencionesCuentas' => [
            'table' => 'sadm_tasas_retenciones_cuentas',
            'fields' => [
                'adtrcId' => 'sadm_adtrc_id',
                'taretId' => 'sadm_taret_id',
            ],
        ],
    ];

    public static function getTableName($logical) {
        return self::$map[$logical]['table'] ?? $logical;
    }

    public static function getField($logicalTable, $logicalField) {
        return self::$map[$logicalTable]['fields'][$logicalField] ?? $logicalField;
    }
}

// core/QueryBuilder.php
class QueryBuilder {
    public function buildSelect($data) {
        $mainTable = ModelMapper::getTableName($data['tabla']);
        $alias = $data['alias'];

        $select = array_map(function($campo) use ($data) {
            [$alias, $logicalField] = explode('.', $campo);
            $physical = ModelMapper::getField($data['tabla'], $logicalField);
            return "$alias.$physical AS $logicalField";
        }, $data['select']);

        $sql = "SELECT " . implode(", ", $select) . " FROM $mainTable $alias";

        if (!empty($data['joins'])) {
            foreach ($data['joins'] as $join) {
                $joinTable = ModelMapper::getTableName($join['tabla']);
                $sql .= " LEFT JOIN $joinTable {$join['alias']} ON {$join['on']}";
            }
        }

        if (!empty($data['where'])) {
            $where = array_map(fn($w) => $w['validacion'], $data['where']);
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        return $sql;
    }

    public function buildInsert($tabla, $campos) {
        $table = ModelMapper::getTableName($tabla);
        $columns = [];
        $values = [];

        foreach ($campos as $campo) {
            $columns[] = ModelMapper::getField($tabla, $campo['nombre']);
            $values[] = "'" . addslashes($campo['valor']) . "'";
        }

        return "INSERT INTO $table (" . implode(",", $columns) . ") VALUES (" . implode(",", $values) . ")";
    }

    public function buildUpdate($tabla, $campos, $where) {
        $table = ModelMapper::getTableName($tabla);
        $set = [];

        foreach ($campos as $campo) {
            $col = ModelMapper::getField($tabla, $campo['nombre']);
            $set[] = "$col = '" . addslashes($campo['valor']) . "'";
        }

        $whereClause = implode(" AND ", array_map(fn($w) => $w['validacion'], $where));

        return "UPDATE $table SET " . implode(", ", $set) . " WHERE $whereClause";
    }
}

// core/DatabaseExecutor.php
class DatabaseExecutor {
    private $conn;

    public function __construct($mysqli_connection) {
        $this->conn = $mysqli_connection;
    }

    public function execute($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            throw new Exception("Database error: " . $this->conn->error);
        }
        return $result;
    }
}

// Ejemplo de uso:
// $builder = new QueryBuilder();
// $sql = $builder->buildSelect($sql_database);
// $executor = new DatabaseExecutor($mysqli);
// $result = $executor->execute($sql);





<?php

class FieldValidator {
    private $mapper;

    public function __construct(ModelMapper $mapper) {
        $this->mapper = $mapper;
    }

    /**
     * Valida que todos los campos lógicos existan en el ModelMapper.
     * @param string $tabla Nombre lógico de la tabla.
     * @param array $campos Array de campos => valor o array de nombres lógicos.
     * @throws Exception Si se encuentra un campo no válido.
     */
    public function validateFields(string $tabla, $campos) {
        $validos = $this->mapper->getFields($tabla);

        // Soporte para array simple ['campo1', 'campo2'] o ['campo1' => valor1]
        if (array_values($campos) === $campos) {
            // array simple
            foreach ($campos as $campo) {
                if (!isset($validos[$campo])) {
                    throw new Exception("Campo lógico '$campo' no válido en tabla '$tabla'");
                }
            }
        } else {
            // array asociativo
            foreach ($campos as $campo => $valor) {
                if (!isset($validos[$campo])) {
                    throw new Exception("Campo lógico '$campo' no válido en tabla '$tabla'");
                }
            }
        }

        return true;
    }

    /**
     * Valida campos en cláusulas WHERE
     */
    public function validateWhere(string $tabla, array $where) {
        $validos = $this->mapper->getFields($tabla);
        foreach ($where as $condicion) {
            preg_match_all('/\b(\w+)\.(\w+)\b/', $condicion, $matches);
            if (!empty($matches[2])) {
                foreach ($matches[2] as $campo) {
                    if (!in_array($campo, array_keys($validos))) {
                        throw new Exception("Campo '$campo' no válido en WHERE de la tabla '$tabla'");
                    }
                }
            }
        }
        return true;
    }
}
