delimiter |
drop procedure if exists sp_refresh_banlist|
drop procedure if exists sp_ban|
drop procedure if exists sp_check_ban|
drop procedure if exists sp_bans_get|
drop procedure if exists sp_bans_delete|
drop procedure if exists sp_bans_unban|
drop procedure if exists sp_boards_get_allowed|
drop procedure if exists sp_boards_get_preview|
drop procedure if exists sp_boards_get_all|
drop procedure if exists sp_boards_get_specifed|
drop procedure if exists sp_boards_add|
drop procedure if exists sp_boards_edit|
drop procedure if exists sp_boards_delete|
drop procedure if exists sp_user_settings_get|
drop procedure if exists sp_save_user_settings|
drop procedure if exists sp_group_get|
drop procedure if exists sp_group_add|
drop procedure if exists sp_group_delete|
drop procedure if exists sp_user_groups_get|
drop procedure if exists sp_user_groups_add|
drop procedure if exists sp_user_groups_edit|
drop procedure if exists sp_user_groups_delete|
drop procedure if exists sp_acl_get|
drop procedure if exists sp_acl_add|
drop procedure if exists sp_acl_edit|
drop procedure if exists sp_acl_delete|
drop procedure if exists sp_languages_get|
drop procedure if exists sp_languages_add|
drop procedure if exists sp_languages_delete|
drop procedure if exists sp_stylesheets_get|
drop procedure if exists sp_stylesheets_add|
drop procedure if exists sp_stylesheets_delete|
drop procedure if exists sp_categories_get|
drop procedure if exists sp_categories_add|
drop procedure if exists sp_categories_delete|
drop procedure if exists sp_upload_handlers_get|
drop procedure if exists sp_upload_handlers_add|
drop procedure if exists sp_upload_handlers_delete|
drop procedure if exists sp_popdown_handlers_get|
drop procedure if exists sp_popdown_handlers_add|
drop procedure if exists sp_popdown_handlers_delete|
drop procedure if exists sp_upload_types_get|
drop procedure if exists sp_upload_types_add|
drop procedure if exists sp_upload_types_edit|
drop procedure if exists sp_upload_types_delete|
drop procedure if exists sp_board_upload_types_get|
drop procedure if exists sp_board_upload_types_add|
drop procedure if exists sp_board_upload_types_delete|
drop procedure if exists sp_threads_get_preview|
drop procedure if exists sp_posts_get_preview|
drop procedure if exists sp_posts_uploads_get_all|
drop procedure if exists sp_uploads_get_all|
drop procedure if exists sp_hidden_threads_get_all|
drop procedure if exists sp_upload_types_get_preview|

create procedure sp_refresh_banlist ()
begin
delete from bans where untill <= now();
end|

create procedure sp_ban
(
	_range_beg int,
	_range_end int,
	_reason text,
	_untill datetime
)
begin
call sp_refresh_banlist();

if _reason = '' or _reason is null
then
	insert into bans (range_beg, range_end, reason, untill) values (_range_beg, _range_end, null, _untill);
else
	insert into bans (range_beg, range_end, reason, untill) values (_range_beg, _range_end, _reason, _untill);
end if;
end|

create procedure sp_check_ban
(
	ip int
)
begin
call sp_refresh_banlist();
select range_beg, range_end, untill, reason from bans where range_beg <= ip and range_end >= ip order by range_end desc limit 1;
end|

create procedure sp_boards_get_allowed
(
	user int
)
begin
	select b.id, b.`name`, b.title, b.bump_limit, b.same_upload, b.popdown_handler, b.category
	from boards b
	join user_groups ug on ug.user = user
	left join acl a1 on ug.`group` = a1.`group` and a1.board is null and a1.thread is null and a1.post is null -- права для определённой группы, для любой доски для любой нити для любого сообщения (x, null, null, null)
	left join acl a2 on a2.`group` is null and b.id = a2.board and a2.thread is null and a2.post is null -- права для любой группы для определённой доски для любой нити для любого сообщения (null, x, null, null)
	left join acl a3 on ug.`group` = a3.`group` and b.id = a3.board and a2.thread is null and a2.post is null -- права для определённой группы для определённой доски для любой нити для любого сообщения (x, x, null, null)
	group by b.id
	having max(coalesce(a3.view, a2.view, a1.view)) = 1
	order by b.category, b.`name`;
end|

create procedure sp_boards_get_preview
(
	_user int
)
begin
	select b.id, b.`name`, b.title, b.bump_limit, b.same_upload, b.popdown_handler, b.category, count(t.id) as threads_count
	from boards b
	join user_groups ug on ug.user = _user
	left join threads t on t.board = b.id
	left join hidden_threads ht on ht.user = _user and ht.thread = t.id
	left join acl a1 on ug.`group` = a1.`group` and a1.board is null and a1.thread is null and a1.post is null
	left join acl a2 on a2.`group` is null and b.id = a2.board
	left join acl a3 on ug.`group` = a3.`group` and b.id = a3.board
	left join acl a4 on a4.`group` is null and t.id = a4.thread
	left join acl a5 on ug.`group` = a5.`group` and t.id = a5.thread
	where ht.thread is null
	group by b.id
	having max(coalesce(a3.view, a2.view, a1.view)) = 1 and (max(coalesce(a4.view, a5.view)) = 1 or max(coalesce(a4.view, a5.view)) is null)
	order by b.category, b.`name`;
end|

create procedure sp_boards_get_specifed
(
	board_name varchar(16),
	actions int,
	user_id int
)
begin
	declare board_id int;
	select id into board_id from boards where `name` = board_name;
	if board_id is null
	then
		select 'NOT_FOUND' as error;
	else
		if actions = 1
		then
			select b.id, b.`name`, b.title, b.bump_limit, b.same_upload, b.popdown_handler, b.category
			from boards b
			join user_groups ug on ug.`user` = user_id
			left join acl a1 on ug.`group` = a1.`group` and a1.board is null and a1.thread is null and a1.post is null -- права для определённой группы, для любой доски для любой нити для любого сообщения (x, null, null, null)
			left join acl a2 on a2.`group` is null and b.id = a2.board and a2.thread is null and a2.post is null -- права для любой группы для определённой доски для любой нити для любого сообщения (null, x, null, null)
			left join acl a3 on ug.`group` = a3.`group` and b.id = a3.board and a2.thread is null and a2.post is null -- права для определённой группы для определённой доски для любой нити для любого сообщения (x, x, null, null)
			where b.id = board_id
			group by b.id
			having max(coalesce(a3.view, a2.view, a1.view)) = 1
			order by b.category, b.`name`;
		else
			if actions = 2
			then
				select b.id, b.`name`, b.title, b.bump_limit, b.same_upload, b.popdown_handler, b.category
				from boards b
				join user_groups ug on ug.`user` = user_id
				left join acl a1 on ug.`group` = a1.`group` and a1.board is null and a1.thread is null and a1.post is null -- права для определённой группы, для любой доски для любой нити для любого сообщения (x, null, null, null)
				left join acl a2 on a2.`group` is null and b.id = a2.board and a2.thread is null and a2.post is null -- права для любой группы для определённой доски для любой нити для любого сообщения (null, x, null, null)
				left join acl a3 on ug.`group` = a3.`group` and b.id = a3.board and a2.thread is null and a2.post is null -- права для определённой группы для определённой доски для любой нити для любого сообщения (x, x, null, null)
				where b.id = board_id
				group by b.id
				having max(coalesce(a3.change, a2.change, a1.change)) = 1
				order by b.category, b.`name`;

			else
				if actions = 3
				then
					select b.id, b.`name`, b.title, b.bump_limit, b.same_upload, b.popdown_handler, b.category
					from boards b
					join user_groups ug on ug.`user` = user_id
					left join acl a1 on ug.`group` = a1.`group` and a1.board is null and a1.thread is null and a1.post is null -- права для определённой группы, для любой доски для любой нити для любого сообщения (x, null, null, null)
					left join acl a2 on a2.`group` is null and b.id = a2.board and a2.thread is null and a2.post is null -- права для любой группы для определённой доски для любой нити для любого сообщения (null, x, null, null)
					left join acl a3 on ug.`group` = a3.`group` and b.id = a3.board and a2.thread is null and a2.post is null -- права для определённой группы для определённой доски для любой нити для любого сообщения (x, x, null, null)
					where b.id = board_id
					group by b.id
					having max(coalesce(a3.moderate, a2.moderate, a1.moderate)) = 1
					order by b.category, b.`name`;
				end if;
			end if;
		end if;
	end if;
end|

create procedure sp_boards_get_all ()
begin
	select id, `name`, title, bump_limit, same_upload, popdown_handler, category from boards;
end|

create procedure sp_user_settings_get
(
	_keyword varchar(32)
)
begin
	declare user_id int;
	select id into user_id from users where keyword = _keyword;

	select u.id, u.posts_per_thread, u.threads_per_page, u.lines_per_post,
		l.`name` as `language`, s.`name` as `stylesheet`, u.rempass
	from users u
	join stylesheets s on u.stylesheet = s.id
	join languages l on u.`language` = l.id
	where u.keyword = _keyword;

	select g.`name` from user_groups ug
	join users u on ug.`user` = u.id and u.id = user_id
	join groups g on ug.`group` = g.id;
end|

create procedure sp_save_user_settings
(
	_keyword varchar(32),
	_threads_per_page int,
	_posts_per_thread int,
	_lines_per_post int,
	_stylesheet varchar(50),
	_language varchar(50),
	_rempass varchar(12)
)
begin
	declare user_id int;
	declare stylesheet_id int;
	declare language_id int;
	set @user_id = null;
	select id into user_id from users where keyword = _keyword;
	select id into stylesheet_id from stylesheets where name = _stylesheet;
	select id into language_id from languages where name = _language;
	if(_rempass = '')
	then
		set _rempass = null;
	end if;
	if(user_id is null)
	then
		-- Создаём ногового пользователя
		start transaction;
		insert into users (keyword, threads_per_page, posts_per_thread, lines_per_post, stylesheet, `language`, rempass)
		values (_keyword, _threads_per_page, _posts_per_thread, _lines_per_post, stylesheet_id, language_id, _rempass);
		select last_insert_id() into user_id;
		insert into user_groups (`user`, `group`) select user_id, id from groups where name = 'Users';
		commit;
	else
		-- Редактируем настройки существующего
		update users set threads_per_page = _threads_per_page, posts_per_thread = _posts_per_thread, lines_per_post = _lines_per_post, stylesheet = stylesheet_id, `language` = language_id, rempass = _rempass where id = user_id;
	end if;
end|

create procedure sp_group_get ()
begin
	select id, `name` from groups order by id;
end|

create procedure sp_group_add
(
	_name varchar(50)
)
begin
	declare group_id int;
	start transaction;
	insert into groups (`name`) values (_name);
	select id into group_id from groups where name = _name;
	-- Стандартные права как для Гостя
	insert into acl (`group`, `view`, `change`, moderate) values (group_id, 1, 0, 0);
	commit;
end|

create procedure sp_group_delete
(
	_id int
)
begin
	start transaction;
	-- TODO: Сделать просто каскадное удалени
	delete from acl where `group` = _id;
	delete from user_groups where `group` = _id;
	delete from groups where id = _id;
	commit;
end|

create procedure sp_user_groups_get ()
begin
	select `user`, `group` from user_groups order by `user`, `group`;
end|

create procedure sp_user_groups_add
(
	user_id int,
	group_id int
)
begin
	insert into user_groups (`user`, `group`) values (user_id, group_id);
end|

create procedure sp_user_groups_edit
(
	user_id int,
	old_group_id int,
	new_group_id int
)
begin
	update user_groups set `group` = new_group_id where `user` = user_id and `group` = old_group_id;
end|

create procedure sp_user_groups_delete
(
	user_id int,
	group_id int
)
begin
	delete from user_groups where `user` = user_id and `group` = group_id;
end|

create procedure sp_acl_get ()
begin
	select `group`, `board`, `thread`, `post`, `view`, `change`, `moderate` from acl order by `group`, `board`, `thread`, `post`;
end|

create procedure sp_acl_add
(
	group_id int,
	board_id int,
	thread_num int,
	post_num int,
	`view` bit,
	`change` bit,
	moderate bit
)
begin
	if group_id = -1
	then
		set group_id = null;
	end if;
	if board_id = -1
	then
		set board_id = null;
	end if;
	if thread_num = -1
	then
		set thread_num = null;
	end if;
	if post_num = -1
	then
		set post_num = null;
	end if;
	insert into acl (`group`, `board`, `thread`, `post`, `view`, `change`, `moderate`) values (group_id, board_id, thread_num, post_num, `view`, `change`, moderate);
end|

create procedure sp_acl_edit
(
	group_id int,
	board_id int,
	thread_num int,
	post_num int,
	_view bit,
	_change bit,
	_moderate bit
)
begin
	if group_id = -1
	then
		set group_id = null;
	end if;
	if board_id = -1
	then
		set board_id = null;
	end if;
	if thread_num = -1
	then
		set thread_num = null;
	end if;
	if post_num = -1
	then
		set post_num = null;
	end if;
	update acl set `view` = _view, `change` = _change, `moderate` = _moderate where ((`group` = group_id) or (coalesce(`group`, group_id) is null)) and ((`board` = board_id) or (coalesce(`board`, board_id) is null)) and ((`thread` = thread_num) or (coalesce(`thread`, thread_num) is null)) and ((`post` = post_num) or (coalesce(`post`, post_num) is null));
end|

create procedure sp_acl_delete
(
	group_id int,
	board_id int,
	thread_num int,
	post_num int
)
begin
	if group_id = -1
	then
		set group_id = null;
	end if;
	if board_id = -1
	then
		set board_id = null;
	end if;
	if thread_num = -1
	then
		set thread_num = null;
	end if;
	if post_num = -1
	then
		set post_num = null;
	end if;
	delete from acl where ((`group` = group_id) or (coalesce(`group`, group_id) is null)) and ((`board` = board_id) or (coalesce(`board`, board_id) is null)) and ((`thread` = thread_num) or (coalesce(`thread`, thread_num) is null)) and ((`post` = post_num) or (coalesce(`post`, post_num) is null));
end|

create procedure sp_languages_get ()
begin
	select id, `name` from languages;
end|

create procedure sp_languages_add
(
	new_language_name varchar(50)
)
begin
	insert into languages (`name`) values (new_language_name);
end|

create procedure sp_languages_delete
(
	_id int
)
begin
	delete from languages where id = _id;
end|

create procedure sp_stylesheets_get ()
begin
	select id, `name` from stylesheets;
end|

create procedure sp_stylesheets_add
(
	new_stylesheet_name varchar(50)
)
begin
	insert into stylesheets (`name`) values (new_stylesheet_name);
end|

create procedure sp_stylesheets_delete
(
	_id int
)
begin
	delete from stylesheets where id = _id;
end|

create procedure sp_categories_get ()
begin
	select id, `name` from categories;
end|

create procedure sp_categories_add
(
	new_category_name varchar(50)
)
begin
	insert into categories (`name`) values (new_category_name);
end|

create procedure sp_categories_delete
(
	_id int
)
begin
	delete from categories where id = _id;
end|

create procedure sp_upload_handlers_get ()
begin
	select id, `name` from upload_handlers;
end|

create procedure sp_upload_handlers_add
(
	new_upload_handler_name varchar(50)
)
begin
	insert into upload_handlers (`name`) values (new_upload_handler_name);
end|

create procedure sp_upload_handlers_delete
(
	_id int
)
begin
	delete from upload_handlers where id = _id;
end|

create procedure sp_popdown_handlers_get ()
begin
	select id, `name` from popdown_handlers;
end|

create procedure sp_popdown_handlers_add
(
	new_popdown_handler_name varchar(50)
)
begin
	insert into popdown_handlers (`name`) values (new_popdown_handler_name);
end|

create procedure sp_popdown_handlers_delete
(
	_id int
)
begin
	delete from popdown_handlers where id = _id;
end|

create procedure sp_upload_types_get ()
begin
	select id, extension, store_extension, upload_handler, thumbnail_image from upload_types;
end|

create procedure sp_upload_types_add
(
	_extension varchar(10),
	_store_extension varchar(10),
	_upload_handler_id int,
	_thumbnail_image_name varchar(256)
)
begin
	if _thumbnail_image_name = ''
	then
		set _thumbnail_image_name = null;
	end if;
	insert into upload_types (extension, store_extension, upload_handler, thumbnail_image) values (_extension, _store_extension, _upload_handler_id, _thumbnail_image_name);
end|

create procedure sp_upload_types_edit
(
	_id int,
	_store_extension varchar(10),
	_upload_handler_id int,
	_thumbnail_image_name varchar(256)
)
begin
	if _thumbnail_image_name = ''
	then
		set _thumbnail_image_name = null;
	end if;
	update upload_types set store_extension = _store_extension, upload_handler = _upload_handler_id, thumbnail_image = _thumbnail_image_name where id = _id;
end|

create procedure sp_upload_types_delete
(
	_id int
)
begin
	delete from upload_types where id = _id;
end|

create procedure sp_board_upload_types_get ()
begin
	select board, upload_type from board_upload_types;
end|

create procedure sp_board_upload_types_add
(
	_board int,
	_upload_type int
)
begin
	insert into board_upload_types (board, upload_type) values (_board, _upload_type);
end|

create procedure sp_board_upload_types_delete
(
	_board int,
	_upload_type int
)
begin
	delete from board_upload_types where board = _board and upload_type = _upload_type;
end|

create procedure sp_boards_add
(
	_name varchar(16),
	_title varchar(50),
	_bump_limit int,
	_same_upload varchar(32),
	_popdown_handler int,
	_category int
)
begin
	if _title = ''
	then
		set _title = null;
	end if;
	insert into boards (`name`, title, bump_limit, same_upload,
		popdown_handler, category) values (_name, _title, _bump_limit,
			_same_upload, _popdown_handler, _category);
end|

create procedure sp_boards_edit
(
	_id int,
	_title varchar(50),
	_bump_limit int,
	_same_upload varchar(32),
	_popdown_handler int,
	_category int
)
begin
	if _title = ''
	then
		set _title = null;
	end if;
	update boards set title = _title, bump_limit = _bump_limit,
		same_upload = _same_upload, popdown_handler = _popdown_handler,
		category = _category where id = _id;
end|

create procedure sp_boards_delete
(
	_id int
)
begin
	delete from boards where id = _id;
end|

create procedure sp_bans_get ()
begin
	select id, range_beg, range_end, reason, untill from bans;
end|

create procedure sp_bans_delete
(
	_id int
)
begin
	delete from bans where id = _id;
end|

create procedure sp_bans_unban
(
	ip int
)
begin
	delete from bans where range_beg <= ip and range_end >= ip;
end|

create procedure sp_threads_get_preview
(
	board_id int,
	page int,
	user_id int,
	threads_per_page int
)
begin
	/* Потому что в limit нельзя использовать переменные */
	prepare stmnt from
		'select t.id, t.original_post, t.bump_limit, t.sage, t.with_images, count(p.id) as posts_count
		from threads t
		join boards b on b.id = t.board and b.id = ?
		join posts p on p.board = ? and p.thread = t.id
		join user_groups ug on ug.`user` = ?
		left join hidden_threads ht on t.id = ht.thread and ug.`user` = ht.`user`
		left join acl a1 on a1.`group` = ug.`group` and a1.thread = t.id
		left join acl a2 on a2.`group` is null and a2.thread = t.id
		left join acl a3 on a3.`group` = ug.`group` and a3.post = p.id
		left join acl a4 on a4.`group` is null and a4.post = p.id
		where (t.deleted = 0 or t.deleted is null) and (t.archived = 0 or t.archived is null) and ht.thread is null and (p.sage is null or p.sage = 0)
		group by t.id
		having (max(coalesce(a1.view, a2.view)) = 1 or max(coalesce(a1.view, a2.view)) is null) and (max(coalesce(a3.view, a3.view)) = 1 or max(coalesce(a3.view, a4.view)) is null)
		order by max(p.`number`) desc
		limit ? offset ?';
	/* Потому что в prepare можно использовать только переменные */
	set @board_id = board_id;
	set @user_id = user_id;
	if(page = 1) then
		set @offset = 0;
		set @limit = threads_per_page;
	else
		set @offset = threads_per_page * (page - 1);
		set @limit = threads_per_page + (page - 1);
	end if;
	execute stmnt using @board_id, @board_id, @user_id, @limit, @offset;
	deallocate prepare stmnt;
end|

create procedure sp_posts_get_preview
(
	thread_id int,
	user_id int,
	posts_per_thread int
)
begin
	prepare stmnt from
		'select p.id, p.thread, p.number, p.password, p.name, p.ip, p.subject, p.date_time, p.text, p.sage
		from posts p
		join threads t on p.board = t.board and p.thread = t.id
		join user_groups ug on ug.user = ?
		left join acl a1 on a1.group = ug.group and a1.post = p.id
		left join acl a2 on a2.group is null and a2.post = p.id
		where p.thread = ? and p.number != t.original_post
		group by p.id
		having max(coalesce(a1.view, a2.view)) = 1 or max(coalesce(a1.view, a2.view)) is null
		limit ?
		union all
		select p.id, p.thread, p.number, p.password, p.name, p.ip, p.subject, p.date_time, p.text, p.sage
		from posts p
		join threads t on p.board = t.board and p.thread = t.id
		where p.number = t.original_post and p.thread = ?
		order by number desc';
	set @user_id = user_id;
	set @thread_id = thread_id;
	set @limit = posts_per_thread;
	execute stmnt using @user_id, @thread_id, @limit, @thread_id;
	deallocate prepare stmnt;
end|

create procedure sp_posts_uploads_get_all
(
	post_id int
)
begin
	select post, upload from posts_uploads where post = post_id;
end|

create procedure sp_uploads_get_all
(
	post_id int
)
begin
	select id, `hash`, is_image, file_name, file_w, file_h, `size`,
		thumbnail_name, thumbnail_w, thumbnail_h
	from uploads u
	join posts_uploads pu on pu.upload = u.id and pu.post = post_id;
end|

create procedure sp_hidden_threads_get_all
(
	board_id int,
	user_id int
)
begin
	select t.id, t.original_post
	from hidden_threads ht
	join threads t on ht.thread = t.id and t.board = board_id
	where ht.user = user_id;
end|

create procedure sp_upload_types_get_preview
(
	board_id int
)
begin
	select ut.extension
	from upload_types ut
	join board_upload_types but on ut.id = but.upload_type and but.board = board_id;
end|