<?php
# Filename: libs.inc.php

# the exact path is defined.
$fixpath = dirname(__FILE__);

# changes this value according to your uploaded smarty distribution.
# don't forget to add trailing back slash
# change 'username' to your username on web hosting account
define("SMARTY_DIR", "libs/");
require_once (SMARTY_DIR . "Smarty.class.php");
$smarty = new Smarty;
include_once 'include/db_connect.php';
include_once 'include/functions.php';

require_once ('admin/application/DBHelper.class.php');
require_once ('admin/application/Sector.class.php');
require_once ('admin/application/Course.class.php');
require_once ('admin/application/Skill.class.php');

require_once ('admin/application/State.class.php');
require_once ('admin/application/District.class.php');
require_once ('admin/application/Area.class.php');
require_once ('admin/application/Locality.class.php');

require_once ('admin/application/User.class.php');
require_once ('admin/application/Articles.class.php');
require_once ('admin/application/Blog.class.php');
require_once ('admin/application/Candidate.class.php');
require_once ('admin/application/Employer.class.php');
require_once ('admin/application/Guru.class.php');
require_once ('admin/application/Skillmitra.class.php');
require_once ('admin/application/Tp.class.php');
require_once ('admin/application/Trainee.class.php');
require_once ('admin/application/Message.class.php');
require_once ('admin/application/CandidateAvailability.class.php');
require_once ('admin/application/HireCandidate.class.php');
require_once ('admin/application/UserRating.class.php');
require_once ('admin/application/EmployementHistory.class.php');
require_once ('admin/application/GenerateInvoice.class.php');
require_once ('admin/application/Mailer.class.php');
require_once ('admin/application/EmployerJobs.class.php');
require_once ('admin/application/EmployerJobLocation.class.php');
require_once ('admin/application/CandidateDoc.class.php' );
require_once ('admin/application/CandidateLocation.class.php' );
require_once ('admin/application/CandidateSkill.class.php' );
require_once ('admin/application/LocationTracker.class.php' );
require_once ('admin/application/UserEducation.class.php' );
require_once ('admin/application/VideoSession.class.php' );
require_once ('admin/application/DailyDelivery.class.php' );
require_once ('admin/application/LogisticPKT.class.php' );
require_once ('admin/application/BankDetails.class.php' );
require_once ('admin/application/Company.class.php' );
require_once ('admin/application/Subscription.class.php');
require_once ('admin/application/SkillchampsCredit.class.php');
require_once ('admin/application/SubscriptionFeature.class.php');
require_once ('admin/application/PaytmKit/redirect_config.php' );
$message = new Message;
$sector = new Sector;
$course = new Course;
$skill = new Skill;

$state = new State;
$district = new District;
$area = new Area;
$locality = new Locality;
$dbHelper = new DBHelper;

$user = new User;
$article = new Articles;
$blog = new Blog;
$candidate = new Candidate;
$emp = new Employer;
$guru = new Guru;
$skillMitra = new Skillmitra;
$tp = new Tp;
$trainee = new Trainee;
$mailer = new Mailer;
$candidateAvailability = new CandidateAvailability;
$hireCandidate = new HireCandidate;
$empJob = new EmployerJobs;
$userRating = new UserRating;
$employementHistory = new EmployementHistory;
$empJobLocation = new EmployerJobLocation;
$candidateDocs = new CandidateDoc;
$candidateLoc = new CandidateLocation;
$candidateSkill = new CandidateSkill;
$locTrack=new LocationTracker;
$userEducation = new UserEducation;$videoSession=new VideoSession;
    $dailyDelivery = new DailyDelivery;
    $logPkt = new LogisticPKT;
    $bankDetails = new BankDetails;
    $company=new Company;
    $subscription = new Subscription;
    $skillchampsCredit = new SkillchampsCredit;
    $subscriptionFeature = new SubscriptionFeature;
?>
