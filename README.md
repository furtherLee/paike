Paike
======
Paike is a project proposed by [Li Shijian](http://github.com/furtherLee) as a course project of Web Design in Shanghai Jiaotong University. The project targets to provide a portable and flexible way for managers of clubs to assign different jobs. 

Motivation
-----------
Li was a staff of the Modern Stadium in Shanghai Jiaotong University. Mr. Lan is the one who is responsable for job arragement. Li heard from Mr. Lan that, job arrangement is so boring that would take him one hour each week, only randomly assigning one person to one job. Li thought such a work can be easily finished by a simple Matching Algorithm. So, Li wrote a small program to help Mr. Lan in C++, which only takes less than 1s to finish the whole work. But, this program is specified to the job system in our Stadium.

Many friends of Li are presidents of different clubs. They told Li that they all have such problems. Jobs are randomly assigned to whoever has time, which is simple but boring. They put the results in to an excel(OK, I'm not a Windows fun), then send it to all their members or a public email. Therefore, Li and his friends, Zhang Xinjian, and Jiang Zhansheng, decide to take this topic as our final project in the Web Design Course.

Design
------
Our user are job arrangers and staff in university. Every one can set up a group. A group is an unit of job arrangement, it may be a club, or just members of an activity. A job arranger can establish many jobs in a group, such as Manager on Monday 6:30 p.m., Staff on Sunday 4:00 p.m. Once jobs are set up, all users in the group can choose which job they can do, and this will generate a worker-job map. After all staff set up their available time, job arranger can assign jobs, which we call it a *Schedule*. The arrangement can be done through a random process or just manually on the website (Well, it is more friendly to users, since it can hint for available jobs). After a schedule is determined, all users can see their works on the website.

Architecture
-------------
The whole project is built up by PHP. We use *flourish* for general framework, including database configuration, sessions, *slim* for routing, and *twig* for template engine. On the foreground, we use *mustache* for template rendering, *bootstrap* for css and jQuery. MySQL is our DBMS, which is required by this course.

* [flourish](http://flourishlib.com/)  
* [slim](http://www.slimframework.com/)  
* [twig](http://twig.sensiolabs.org/)  
* [mustache](http://mustache.github.com/)  
* [bootstrap](http://twitter.github.com/bootstrap/)  
* [jQuery](http://jquery.com/)  
* [MySQL](http://www.mysql.com/)  

Analysis
---------
I have searched many cases about job arrangement. Random assignment is the simplest and most used in university. This can be finished by simple maximum matching algorithm such as Hungarian Method. However, a job system may have different roles, for instance, in Modern Stadium we have manager and staff, each job must have one manager and three staff. Meanwhile, a manager can do a staff's job, but a staff cannot handle managers' affairs. Such cases can be induced to two arrangement, one for manager and one for staff. Managers are assigned first and staff second, so the remained managers can be assigned to staff jobs. Mr. Lan wants some randomness in this, because we have many managers, they are unhappy if assigned an staff job. So just keep a random mapping for all employees and randomly shuffle the map.

However, there must be more complicated cases. For example, each job must have staffs and a manager of both gender, because we may be asked to turn on the lights in washingrooms of both genders. Such a requirement is hard to compute, since simple matching algorithm cannot handle general SAT problems (Although, there are many approximation algorithms, but the performance is poor). That's why we add some interaction for our users. (Maybe we will have a more powerful server, and try some different algorithms)


License: [DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE](http://sam.zoy.org/wtfpl/COPYING)

Author: [Li Shijian](http://github.com/furtherLee)
