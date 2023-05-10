<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper6af4d594edb1\Monolog\Handler;

use _PhpScoper6af4d594edb1\Elastica\Document;
use _PhpScoper6af4d594edb1\Monolog\Formatter\FormatterInterface;
use _PhpScoper6af4d594edb1\Monolog\Formatter\ElasticaFormatter;
use _PhpScoper6af4d594edb1\Monolog\Level;
use _PhpScoper6af4d594edb1\Elastica\Client;
use _PhpScoper6af4d594edb1\Elastica\Exception\ExceptionInterface;
use _PhpScoper6af4d594edb1\Monolog\LogRecord;
/**
 * Elastic Search handler
 *
 * Usage example:
 *
 *    $client = new \Elastica\Client();
 *    $options = array(
 *        'index' => 'elastic_index_name',
 *        'type' => 'elastic_doc_type', Types have been removed in Elastica 7
 *    );
 *    $handler = new ElasticaHandler($client, $options);
 *    $log = new Logger('application');
 *    $log->pushHandler($handler);
 *
 * @author Jelle Vink <jelle.vink@gmail.com>
 * @phpstan-type Options array{
 *     index: string,
 *     type: string,
 *     ignore_error: bool
 * }
 * @phpstan-type InputOptions array{
 *     index?: string,
 *     type?: string,
 *     ignore_error?: bool
 * }
 */
class ElasticaHandler extends AbstractProcessingHandler
{
    protected Client $client;
    /**
     * @var mixed[] Handler config options
     * @phpstan-var Options
     */
    protected array $options;
    /**
     * @param Client  $client  Elastica Client object
     * @param mixed[] $options Handler configuration
     *
     * @phpstan-param InputOptions $options
     */
    public function __construct(Client $client, array $options = [], int|string|Level $level = Level::Debug, bool $bubble = \true)
    {
        parent::__construct($level, $bubble);
        $this->client = $client;
        $this->options = \array_merge([
            'index' => 'monolog',
            // Elastic index name
            'type' => 'record',
            // Elastic document type
            'ignore_error' => \false,
        ], $options);
    }
    /**
     * @inheritDoc
     */
    protected function write(LogRecord $record) : void
    {
        $this->bulkSend([$record->formatted]);
    }
    /**
     * @inheritDoc
     */
    public function setFormatter(FormatterInterface $formatter) : HandlerInterface
    {
        if ($formatter instanceof ElasticaFormatter) {
            return parent::setFormatter($formatter);
        }
        throw new \InvalidArgumentException('ElasticaHandler is only compatible with ElasticaFormatter');
    }
    /**
     * @return mixed[]
     *
     * @phpstan-return Options
     */
    public function getOptions() : array
    {
        return $this->options;
    }
    /**
     * @inheritDoc
     */
    protected function getDefaultFormatter() : FormatterInterface
    {
        return new ElasticaFormatter($this->options['index'], $this->options['type']);
    }
    /**
     * @inheritDoc
     */
    public function handleBatch(array $records) : void
    {
        $documents = $this->getFormatter()->formatBatch($records);
        $this->bulkSend($documents);
    }
    /**
     * Use Elasticsearch bulk API to send list of documents
     *
     * @param Document[] $documents
     *
     * @throws \RuntimeException
     */
    protected function bulkSend(array $documents) : void
    {
        try {
            $this->client->addDocuments($documents);
        } catch (ExceptionInterface $e) {
            if (!$this->options['ignore_error']) {
                throw new \RuntimeException("Error sending messages to Elasticsearch", 0, $e);
            }
        }
    }
}
