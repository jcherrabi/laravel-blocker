<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelBlocker\App\Models\BlockedItem;
use jeremykenedy\LaravelBlocker\App\Models\BlockedType;

class BlockedItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Blocked Types
         *
         */
        $BlockedItems = [
            [
                'type'  => 'domain',
                'value' => 'test.com',
                'note'  => 'Block all domains/emails @test.com',
            ],
            [
                'type'  => 'domain',
                'value' => 'fake.com',
                'note'  => 'Block all domains/emails @fake.com',
            ],
            [
                'type'  => 'domain',
                'value' => 'example.com',
                'note'  => 'Block all domains/emails @example.com',
            ],
        ];

        /*
         * Add Blocked Items
         *
         */
        if (config('laravelblocker.seedPublishedBlockedItems')) {
            foreach ($BlockedItems as $BlockedItem) {
                $blockType = BlockedType::where('slug', $BlockedItem['type'])->first();
                $newBlockedItem = BlockedItem::where('typeId', '=', $blockType->id)
                    ->where('value', '=', $BlockedItem['value'])
                    ->first();
                if ($newBlockedItem === null) {
                    $newBlockedItem = BlockedItem::create([
                        'typeId'    => $blockType->id,
                        'value'     => $BlockedItem['value'],
                        'note'      => $BlockedItem['note'],
                    ]);
                }
            }
        }
    }
}