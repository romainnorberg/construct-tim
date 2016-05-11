<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectType;

class LoadProjectData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
      $this->container = $container;
    }

    public function load(ObjectManager $manager) {

      $project_type = new ProjectType();
      $project_type->setTitle('Nouvelles constructions');
      $project_type->setPageTitle('Entrepreneur en construction à Namur et Brabant wallon');
      $project_type->setSlug('entreprise-construction-maison-batiment-namur-brabant-wallon');
      $project_type->setDescription("Entrepreneur en construction &agrave; Namur et Brabant wallon");
      $project_type->setContent("<p>Implant&eacute;e au c&oelig;ur de la <strong>Wallonie</strong>, la SPRL Construct-Tim est une <strong>entreprise g&eacute;n&eacute;rale de b&acirc;timent</strong>. Nous pouvons &ecirc;tre votre partenaire privil&eacute;gi&eacute; pour la r&eacute;alisation de toutes les &eacute;tapes concernant la <strong>construction</strong>, r&eacute;novation, extension&nbsp;de votre bien immobilier.</p>

<p>Nous nous d&eacute;pla&ccedil;ons plus sp&eacute;cifiquement dans les provinces de <strong>Namur, Brabant wallon.</strong></p>

<div>layouts_info_contact</div>

<h2>La SPRL Construct-Tim r&eacute;alise les travaux de construction suivants&nbsp;:</h2>

<p>Notre soci&eacute;t&eacute; travaille de mani&egrave;re traditionnelle et vous propose ses services pour <strong>petits et grands travaux de ma&ccedil;onnerie</strong>, int&eacute;rieure ou ext&eacute;rieure&nbsp;:</p>

<ul>
	<li><strong>Maison unifamiliale, b&acirc;timent multi r&eacute;sidentiel ou am&eacute;nagement int&eacute;rieurs de halls industriels&nbsp;</strong>: Nous collaborons avec votre architecte ou celui que nous vous proposons. Nous remettons prix sur plans et m&eacute;tr&eacute;s.</li>
	<li>Nous effectuons le <strong>gros &oelig;uvre</strong>, ouvert ou ferm&eacute;.</li>
	<li>Parmi nos comp&eacute;tences, nous sommes en mesure&nbsp; d&rsquo;&eacute;valuer les <strong>nouveaux mat&eacute;riaux de construction</strong> mis sur le march&eacute;, ainsi que les <strong>nouvelles techniques d&rsquo;isolation</strong>.</li>
	<li>La pr&eacute;paration de l&rsquo;<strong>ossature bois </strong>(construction de fondations et ma&ccedil;onnerie), de la <strong>maison passive</strong>, basse &eacute;nergie ou &eacute;nergie positive est &eacute;galement notre sp&eacute;cialit&eacute;.</li>
</ul>

<h2>Intervention de diff&eacute;rents corps de m&eacute;tier</h2>

<p>Outre ces prestations, Construct-Tim facilite la mise en place de toutes les &eacute;tapes de la construction de votre habitation. Nous pouvons en effet coordonner les diff&eacute;rents corps de m&eacute;tier qui se succ&eacute;deront sur votre chantier&nbsp;: <strong>Second &oelig;uvre, am&eacute;nagement, finitions.</strong></p>

<p>Nous vous conseillons les <strong>partenaires </strong>les plus<strong> qualifi&eacute;s </strong>et aptes &agrave; allier vos envies et besoins &agrave; votre budget.</p>

<h2>Questions, devis de construction&nbsp;? Contactez-nous d&egrave;s &agrave; pr&eacute;sent&nbsp;!</h2>

<p>Construct-Tim est &agrave; votre &eacute;coute, et met tout son <strong>savoir-faire</strong> &agrave; votre disposition pour r&eacute;aliser des travaux de qualit&eacute; et soign&eacute;s, quelles que soient les contraintes techniques. N&rsquo;h&eacute;sitez donc pas &agrave; poser toute question en ligne, ou &agrave; nous solliciter pour obtenir une offre de prix.</p>
");
      $project_type->setCreated(new \DateTime('2015-07-12 17:11:56'));
      $project_type->setUpdated(new \DateTime('2015-08-20 06:57:59'));
      $manager->persist($project_type);

      $manager->flush();
    }
  }
