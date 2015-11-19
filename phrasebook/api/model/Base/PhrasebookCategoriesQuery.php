<?php

namespace Base;

use \PhrasebookCategories as ChildPhrasebookCategories;
use \PhrasebookCategoriesQuery as ChildPhrasebookCategoriesQuery;
use \Exception;
use \PDO;
use Map\PhrasebookCategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'phrasebook_categories' table.
 *
 *
 *
 * @method     ChildPhrasebookCategoriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPhrasebookCategoriesQuery orderByLang($order = Criteria::ASC) Order by the lang column
 * @method     ChildPhrasebookCategoriesQuery orderByLabel($order = Criteria::ASC) Order by the label column
 *
 * @method     ChildPhrasebookCategoriesQuery groupById() Group by the id column
 * @method     ChildPhrasebookCategoriesQuery groupByLang() Group by the lang column
 * @method     ChildPhrasebookCategoriesQuery groupByLabel() Group by the label column
 *
 * @method     ChildPhrasebookCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPhrasebookCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPhrasebookCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPhrasebookCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPhrasebookCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPhrasebookCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPhrasebookCategoriesQuery leftJoinPhrasebookPhrases($relationAlias = null) Adds a LEFT JOIN clause to the query using the PhrasebookPhrases relation
 * @method     ChildPhrasebookCategoriesQuery rightJoinPhrasebookPhrases($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PhrasebookPhrases relation
 * @method     ChildPhrasebookCategoriesQuery innerJoinPhrasebookPhrases($relationAlias = null) Adds a INNER JOIN clause to the query using the PhrasebookPhrases relation
 *
 * @method     ChildPhrasebookCategoriesQuery joinWithPhrasebookPhrases($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PhrasebookPhrases relation
 *
 * @method     ChildPhrasebookCategoriesQuery leftJoinWithPhrasebookPhrases() Adds a LEFT JOIN clause and with to the query using the PhrasebookPhrases relation
 * @method     ChildPhrasebookCategoriesQuery rightJoinWithPhrasebookPhrases() Adds a RIGHT JOIN clause and with to the query using the PhrasebookPhrases relation
 * @method     ChildPhrasebookCategoriesQuery innerJoinWithPhrasebookPhrases() Adds a INNER JOIN clause and with to the query using the PhrasebookPhrases relation
 *
 * @method     \PhrasebookPhrasesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPhrasebookCategories findOne(ConnectionInterface $con = null) Return the first ChildPhrasebookCategories matching the query
 * @method     ChildPhrasebookCategories findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPhrasebookCategories matching the query, or a new ChildPhrasebookCategories object populated from the query conditions when no match is found
 *
 * @method     ChildPhrasebookCategories findOneById(int $id) Return the first ChildPhrasebookCategories filtered by the id column
 * @method     ChildPhrasebookCategories findOneByLang(string $lang) Return the first ChildPhrasebookCategories filtered by the lang column
 * @method     ChildPhrasebookCategories findOneByLabel(string $label) Return the first ChildPhrasebookCategories filtered by the label column *

 * @method     ChildPhrasebookCategories requirePk($key, ConnectionInterface $con = null) Return the ChildPhrasebookCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhrasebookCategories requireOne(ConnectionInterface $con = null) Return the first ChildPhrasebookCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhrasebookCategories requireOneById(int $id) Return the first ChildPhrasebookCategories filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhrasebookCategories requireOneByLang(string $lang) Return the first ChildPhrasebookCategories filtered by the lang column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPhrasebookCategories requireOneByLabel(string $label) Return the first ChildPhrasebookCategories filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPhrasebookCategories[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPhrasebookCategories objects based on current ModelCriteria
 * @method     ChildPhrasebookCategories[]|ObjectCollection findById(int $id) Return ChildPhrasebookCategories objects filtered by the id column
 * @method     ChildPhrasebookCategories[]|ObjectCollection findByLang(string $lang) Return ChildPhrasebookCategories objects filtered by the lang column
 * @method     ChildPhrasebookCategories[]|ObjectCollection findByLabel(string $label) Return ChildPhrasebookCategories objects filtered by the label column
 * @method     ChildPhrasebookCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PhrasebookCategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PhrasebookCategoriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PhrasebookCategories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPhrasebookCategoriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPhrasebookCategoriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPhrasebookCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildPhrasebookCategoriesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $lang] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPhrasebookCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PhrasebookCategoriesTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PhrasebookCategoriesTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPhrasebookCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, lang, label FROM phrasebook_categories WHERE id = :p0 AND lang = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPhrasebookCategories $obj */
            $obj = new ChildPhrasebookCategories();
            $obj->hydrate($row);
            PhrasebookCategoriesTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPhrasebookCategories|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_LANG, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PhrasebookCategoriesTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PhrasebookCategoriesTableMap::COL_LANG, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the lang column
     *
     * Example usage:
     * <code>
     * $query->filterByLang('fooValue');   // WHERE lang = 'fooValue'
     * $query->filterByLang('%fooValue%'); // WHERE lang LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lang The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterByLang($lang = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lang)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lang)) {
                $lang = str_replace('*', '%', $lang);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_LANG, $lang, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $label)) {
                $label = str_replace('*', '%', $label);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhrasebookCategoriesTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query by a related \PhrasebookPhrases object
     *
     * @param \PhrasebookPhrases|ObjectCollection $phrasebookPhrases the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function filterByPhrasebookPhrases($phrasebookPhrases, $comparison = null)
    {
        if ($phrasebookPhrases instanceof \PhrasebookPhrases) {
            return $this
                ->addUsingAlias(PhrasebookCategoriesTableMap::COL_ID, $phrasebookPhrases->getCatId(), $comparison)
                ->addUsingAlias(PhrasebookCategoriesTableMap::COL_LANG, $phrasebookPhrases->getLang(), $comparison);
        } else {
            throw new PropelException('filterByPhrasebookPhrases() only accepts arguments of type \PhrasebookPhrases');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PhrasebookPhrases relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function joinPhrasebookPhrases($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PhrasebookPhrases');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PhrasebookPhrases');
        }

        return $this;
    }

    /**
     * Use the PhrasebookPhrases relation PhrasebookPhrases object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PhrasebookPhrasesQuery A secondary query class using the current class as primary query
     */
    public function usePhrasebookPhrasesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPhrasebookPhrases($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PhrasebookPhrases', '\PhrasebookPhrasesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPhrasebookCategories $phrasebookCategories Object to remove from the list of results
     *
     * @return $this|ChildPhrasebookCategoriesQuery The current query, for fluid interface
     */
    public function prune($phrasebookCategories = null)
    {
        if ($phrasebookCategories) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PhrasebookCategoriesTableMap::COL_ID), $phrasebookCategories->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PhrasebookCategoriesTableMap::COL_LANG), $phrasebookCategories->getLang(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the phrasebook_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhrasebookCategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PhrasebookCategoriesTableMap::clearInstancePool();
            PhrasebookCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PhrasebookCategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PhrasebookCategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PhrasebookCategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PhrasebookCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PhrasebookCategoriesQuery
