const tinify = require("tinify");
tinify.key = "75b5zNHlx5l6SvXw8xQ1yxfmTz8wgKpv";

const source = tinify.fromUrl("https://tinypng.com/images/panda-happy.png");
source.toFile("roster/optimized.jpg");