<?php
namespace Omeka\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(
 *     indexes={
 *         @Index(
 *             name="page_order",
 *             columns={"page_id", "order"}
 *         )
 *     }
 * )
 */
class SitePageBlock extends AbstractEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(length=80)
     */
    protected $layout;

    /**
     * @Column(type="json_array")
     */
    protected $data;

    /**
     * @Column(type="integer")
     */
    protected $order;

    /**
     * @ManyToOne(targetEntity="SitePage", inversedBy="blocks")
     * @JoinColumn(nullable=false)
     */
    protected $page;

    /**
     * @OneToMany(targetEntity="SiteBlockAttachment", mappedBy="block")
     */
    protected $attachments;

    public function __construct()
    {
        $this->attachments = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setPage(SitePage $page)
    {
        $this->synchronizeOneToMany($page, 'page', 'getBlocks');
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }
}
