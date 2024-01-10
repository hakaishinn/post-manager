<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function ($user) {
            return $user['id'];
        });
        $response = Http::get('https://genplusmedia.online/manager/posts/json/1.json?api_key=0906429283&get_meta=1');
        $posts = collect($response['data'])->map(function ($post) use ($userId) {
            return [
                'id' => $post['id'],
                'name' => $post['name'],
                'slug' => $post['slug'],
                'description' => $post['description'],
                'body' => "<p>In a recent interview with Globo, Neymar discussed the emotional ups and downs he and Lionel Messi went through while playing for PSG.</p><p><img src=\"https://cdn.tuoitre.vn/thumb_w/730/471584752817336320/2023/9/4/messi-neymar-psg-paris-saint-germain--1693776059043417566268.jpg\" alt=\"Điểm tin thể thao sáng 4-9: Neymar: 'Tôi và Messi sống như địa ngục' ở PSG  - Tuổi Trẻ Online\" align=\"center\" style=\"max-width: 100%; margin-bottom: 10px; margin-left: auto; margin-right: auto; display: block;\"></p><p></p><p></p><p></p><p>For a then-record-breaking $240 million transfer fee, Neymar moved to PSG in 2017. Lionel Messi joined in 2021. The soccer world eagerly anticipated the fireworks that would result from the union of these two powerhouses, the UEFA Champions League and Ligue 1. Their professed shared goal was to make history together.</p><p></p><p></p><p></p><p>The most recent comments made by Neymar on his time at PSG show the expectations and standards they had to meet. They undoubtedly excelled on the field and helped PSG win, but they were unable to achieve their ultimate objective of winning the Champions League.</p><p></p><p>Lionel Messi was the subject of comments from Neymar, who said, \"I was very delighted for the year he had, but at the same time very sad, since he lived both sides of the coin, going to heaven with the Argentina squad, winning everything in recent years, and living hell with Paris. He and I both went through hell.</p><hr><p><img src=\"https://pbs.twimg.com/media/F5HcXzkXMAAabNH?format=jpg&amp;name=small\" alt=\"Image\" align=\"center\" style=\"max-width: 100%; margin-bottom: 10px; margin-left: auto; margin-right: auto; display: block;\"></p><p></p><p>\"We get upset because we're not there to slack off; we're there to give it our all, win, and try to make history. That's why we started playing together once more; we went there to work as a team to create history. Unfortunately, we were unsuccessful, he continued.&nbsp;</p><p></p><p>It's possible that the Neymar-Messi pairing at PSG didn't achieve the level of success they had hoped for. They sprinkled the voyage with brilliant and supportive moments.</p><p></p><p>Neymar has conflicting emotions on Lionel Messi leaving PSG.</p><hr><p><img src=\"https://static.onzemondial.com/8/2023/02/photo_article/821039/327671/1200-L-psg-le-constat-terrible-de-messi-neymar-ou-marquinhos-sur-le-niveau-de-l-quipe.jpg\" alt=\"PSG : le constat terrible de Messi, Neymar ou Marquinhos sur le niveau de  l'équipe\" align=\"center\" style=\"max-width: 100%; margin-bottom: 10px; margin-left: auto; margin-right: auto; display: block;\"></p><p>Soccer supporters from all across the world said goodbye to a relationship that had once been expected to transform the game in the summer of 2023. Two of their generation's top soccer players, Neymar and Lionel Messi, left Paris Saint-Germain to take on new challenges.</p><p></p><p>Despite suggestions that they may join FC Barcelona again, each player followed their own path. In the summer of 2023, Messi and Neymar made decisions that created headlines. They decided to embark on new challenges. Neymar signed with Al-Hilal in Saudi Arabia, while Messi embarked on a journey with Inter Miami.</p><p><img src=\"https://d2yoo3qu6vrk5d.cloudfront.net/images/20220313104628/cropped-10de2ee5-1c25-4483-aac4-0f41d841da92-11.webp\" alt=\"Hinchas de PSG silban a Lionel Mesi y Neymar por la eliminación de Champions\" align=\"center\" style=\"max-width: 100%; margin-bottom: 10px; margin-left: auto; margin-right: auto; display: block;\"></p><p></p><p></p><p></p><p>Neymar showed how much he likes and admires his old teammate by making comments regarding Messi leaving PSG as a free agent. He expressed his happiness over Argentina's recent World Cup victory and stated that he believed Messi deserved a more honorable dismissal from the team.</p><p></p><p>Messi departed in a way, according to him, that he didn't deserve for football, he claimed. Anyone who knows him knows that he is a guy who trains, fights, and gets angry if he loses. In my perspective, he was treated unfairly despite everything he is and does. He winning the World Cup made me quite pleased, yet, at the same time. Since the Brazilian team lost, as you indicated, this game of football was fair, and Messi deserved to finish his career this way.</p>",
                'image' => $post['image'],
                'image_name' => $post['image_name'],
                'website_id' => 88,
                'company_id' => $post['company']['id'] != 0 ? $post['company']['id'] : null,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'post_wp_id' => $post['post_wp_id'],
                'status' => 1,
                'meta' => json_encode($post['meta']),
                'yoast-seo' => json_encode($post['yoast-seo']),
            ];
        });

        try {
            foreach ($posts as $post) {
                Post::create($post);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        $postDBs = Post::all();
        $categoryDB = Category::all();
        $postID = Post::all()->map(function ($post) {
            return $post['id'];
        });

        $tagId = Tag::all()->map(function ($tag) {
            return $tag['id'];
        });

        foreach ($postDBs as $postDB) {
            $postDB->tags()->attach([$tagId[array_rand($tagId->toArray())]]);
            $postDB->keywords()->attach(random_int(1, 5));
        };

        foreach ($categoryDB as $category) {
            $category->posts()->attach($postID->random(12));
        }
    }
}
