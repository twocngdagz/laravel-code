<?php

namespace App\Services\Filters;

trait FullTextFilter
{
    protected function clean($term)
    {
        $reserved = ['-', '+', '<', '>', '@', '(', ')', '~'];

        return str_replace($reserved, '', $term);
    }

    protected function applyOperator($term)
    {
        $terms = explode(' ', $term);

        foreach ($terms as $key => $term) {
            if (strlen($term) >= 3) {
                $terms[$key] = '+' . $term . '*';
            }
        }

        return implode(' ', $terms);
    }

    public function search($term)
    {
        $columns = implode(',', $this->searchable);

        $term = $this->clean($term);
        $term = $this->applyOperator($term);

        return $this->builder->selectRaw("*, MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$term])
            ->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $term)
            ->orderByDesc('relevance_score');
    }
}
