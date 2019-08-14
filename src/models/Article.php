<?php

/**
 * Class Article
 */
class Article extends DB_cni {

    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $publicationDate;

    /**
     * @var
     */
    protected $title;

    /**
     * @var
     */
    protected $summary;

    /**
     * @var
     */
    protected $content;

    /**
     * @var
     */
    protected $fileToUpload;

    /**
     * Article constructor.
     * @param $row
     */
    public function __construct($row)
    {
        $this->id = $row['id'];
        $this->publicationDate = $row['publicationDate'];
        $this->title = $row['title'];
        $this->summary = $row['summary'];
        $this->content = $row['content'];
        $this->fileToUpload = $row['fileToUpload'];
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getFileToUpload()
    {
        return $this->fileToUpload;
    }

    /**
     * @param mixed $fileToUpload
     */
    public function setFileToUpload($fileToUpload): void
    {
        $this->fileToUpload = $fileToUpload;
    }

}