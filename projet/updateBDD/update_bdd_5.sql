ALTER TABLE likes
ADD CONSTRAINT post_id_user_id_unique_id UNIQUE (user_id, post_id);