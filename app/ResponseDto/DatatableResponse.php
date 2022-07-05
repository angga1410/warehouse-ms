<?php

namespace App\ResponseDto;

class DatatableResponse
{
    protected $request;
    protected $data;
    protected $total;
    protected $perpage;
    protected $page;
    protected $searchParam;
    protected $searchId;
    protected $sortField;
    protected $sortBy;
    protected $pages;

    public function __construct($request, $data, $searchParam, $searchId)
    {
        $this->request     = $request;
        $this->data        = $data;
        $this->total       = $data->count();
        $this->perpage     = (int)$request->get("pagination")["perpage"];
        $this->page        = (int)$request->get("pagination")["page"];
        $this->orderField  = $this->request->get("sort")["field"];
        $this->orderBy     = $this->request->get("sort")["sort"];
        $this->searchParam = $searchParam;
        $this->pages       = ceil($this->total/$this->perpage);
        $this->searchId    = $searchId;
    }

    private function checkPageLength()
    {
        $this->pages = ceil($this->total/$this->perpage);

        if($this->page > $this->pages) {
            $this->page = 1;
        }
    }

    private function getMeta()
    {
        return [
                "page"    => $this->page,
                "pages"   => $this->pages,
                "perpage" => $this->perpage,
                "total"   => $this->total,
                "sort"    => $this->orderBy,
                "field"   => $this->orderField
            ];
    }

    private function filterResult()
    {
        $query = $this->request->get("query");

        if($query != null && $query != "" && $query[$this->searchId] != null && $query[$this->searchId] != "")
        {
            $filterResult = $this->data->where($this->searchParam, "like", "%". $query[$this->searchId] ."%");
            $this->total  = $filterResult->count();
            $this->checkPageLength();
            return $filterResult;
        }
        return $this->data;
    }

    // public function getResponse() : array
    public function getResponse()
    {
        $filterResult = $this->filterResult();

        $index = $this->page - 1;
        $skip  = $index * $this->perpage;

        $result = $filterResult->skip($skip)->take($this->perpage)->orderBy($this->orderField, $this->orderBy)->get();
        // return $this->orderBy;
        // $result = $filterResult->skip($skip)->take($this->perpage)->orderBy($this->orderField, $this->orderBy);

        return ["meta" => $this->getMeta(), "data" => $result];
    }
}