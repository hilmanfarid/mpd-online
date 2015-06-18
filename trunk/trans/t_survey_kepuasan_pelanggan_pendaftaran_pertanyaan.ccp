<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions" connection="ConnSIKP">
	<Components>
		<Record id="3" sourceType="SQL" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="t_rep_lap_spjpSearch" returnPage="t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.ccp" PathID="t_rep_lap_spjpSearch" pasteActions="pasteActions" pasteAsReplace="pasteAsReplace" connection="ConnSIKP" dataSource="select * from p_survey_question 
WHERE p_survey_question_id={p_survey_question_id}" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList">
			<Components>
				<Button id="573" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch2" PathID="t_rep_lap_spjpSearchButton_DoSearch2">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="555" fieldSourceType="DBColumn" dataType="Text" html="False" name="no" fieldSource="sequence_no" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_rep_lap_spjpSearchno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="575" fieldSourceType="DBColumn" dataType="Text" html="False" name="survey_question" fieldSource="survey_question" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_rep_lap_spjpSearchsurvey_question">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="577" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_survey_question_id" fieldSource="p_survey_question_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_rep_lap_spjpSearchp_survey_question_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<RadioButton id="578" visible="Yes" fieldSourceType="DBColumn" sourceType="SQL" dataType="Text" html="True" returnValueType="Number" name="pilihan_jawaban" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="t_rep_lap_spjpSearchpilihan_jawaban" connection="ConnSIKP" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" dataSource="select p_survey_answer_score,score_number from p_survey_answer_score
where p_survey_question_id = {p_survey_question_id}" boundColumn="p_survey_answer_score_id" textColumn="score_number">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="579" variable="p_survey_question_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_survey_question_id"/>
					</SQLParameters>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</RadioButton>
				<Hidden id="581" fieldSourceType="DBColumn" dataType="Integer" html="False" name="t_vat_registration_id" wizardCaption="Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="t_rep_lap_spjpSearcht_vat_registration_id" fieldSource="t_vat_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="574"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="580" variable="p_survey_question_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="p_survey_question_id"/>
			</SQLParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="Label1" PathID="Label1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.php" forShow="True" url="t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="572"/>
			</Actions>
		</Event>
	</Events>
</Page>
